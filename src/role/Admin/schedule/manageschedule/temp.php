<?php
include '../../../../Controller/connect.php'; // เชื่อมต่อฐานข้อมูล
include 'preparedata.php'; // โหลดข้อมูล $scheduleRules

$unscheduledSubjects = []; // ตัวแปรเก็บวิชาที่ยังไม่ได้บันทึก

// ฟังก์ชันตรวจสอบข้อมูลซ้ำ
function isSubjectScheduled($conn, $subjectID, $classGroupID)
{
  $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM schedule WHERE SubjectID = ? AND ClassGroupID = ?");
  $stmt->bind_param("ii", $subjectID, $classGroupID);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $stmt->close();
  return isset($row['count']) && $row['count'] > 0;
}

// ฟังก์ชันตรวจสอบเวลาที่ว่าง
function isTimeSlotAvailable($conn, $day, $timeSlot, $roomID, $classGroupID)
{
  $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM schedule WHERE DayOfWeek = ? AND TimeSlot = ? AND (RoomID = ? OR ClassGroupID = ?)");
  $stmt->bind_param("ssii", $day, $timeSlot, $roomID, $classGroupID);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $stmt->close();
  return isset($row['count']) && $row['count'] == 0;
}

// ฟังก์ชันตรวจสอบวิชากิจกรรม
function isActivitySubject($subjectName)
{
  return strpos($subjectName, "กิจกรรม") === 0;
}

// ฟังก์ชันสำหรับลงตารางเรียน
function assignSubject($conn, $subject, $classGroup, $teacher, $room, &$unscheduledSubjects)
{
  $days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
  $prioritySlots = [
    'activity' => '7-8',
    '3-4_hours' => ['1-4', '6-9'],
    'continuity' => ['4', '9', '10-12'],
    'default' => ['1-4', '6-9', '10-12']
  ];

  $assigned = false;

  if (isSubjectScheduled($conn, $subject['SubjectID'], $classGroup['ClassGroupID'])) {
    return; // ข้ามรายวิชานี้ถ้าถูกบันทึกแล้ว
  }

  // ตรวจสอบวิชากิจกรรม
  if (isActivitySubject($subject['SubjectName'])) {
    foreach ($days as $day) {
      if (isTimeSlotAvailable($conn, $day, $prioritySlots['activity'], $room['RoomID'], $classGroup['ClassGroupID'])) {
        $stmt = $conn->prepare("INSERT INTO schedule (SubjectID, TeacherID, RoomID, TimeSlot, DayOfWeek, ClassGroupID) VALUES (?, ?, ?, ?, ?, ?)");
        $timeSlot = $prioritySlots['activity'];
        $stmt->bind_param("iiissi", $subject['SubjectID'], $teacher['TeacherID'], $room['RoomID'], $timeSlot, $day, $classGroup['ClassGroupID']);
        $stmt->execute();
        $stmt->close();
        $assigned = true;
        break;
      }
    }
  }

  // ตรวจสอบวิชาชั่วโมง 3-4 ชั่วโมง
  if (!$assigned) {
    foreach ($days as $day) {
      foreach ($prioritySlots['3-4_hours'] as $slot) {
        if (isTimeSlotAvailable($conn, $day, $slot, $room['RoomID'], $classGroup['ClassGroupID'])) {
          $stmt = $conn->prepare("INSERT INTO schedule (SubjectID, TeacherID, RoomID, TimeSlot, DayOfWeek, ClassGroupID) VALUES (?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("iiissi", $subject['SubjectID'], $teacher['TeacherID'], $room['RoomID'], $slot, $day, $classGroup['ClassGroupID']);
          $stmt->execute();
          $stmt->close();
          $assigned = true;
          break 2;
        }
      }
    }
  }

  // ตรวจสอบ Continuity > 0.5
  if (!$assigned && $subject['AvgContinuity'] > 0.5) {
    foreach ($days as $day) {
      foreach ($prioritySlots['continuity'] as $slot) {
        if (isTimeSlotAvailable($conn, $day, $slot, $room['RoomID'], $classGroup['ClassGroupID'])) {
          $stmt = $conn->prepare("INSERT INTO schedule (SubjectID, TeacherID, RoomID, TimeSlot, DayOfWeek, ClassGroupID) VALUES (?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("iiissi", $subject['SubjectID'], $teacher['TeacherID'], $room['RoomID'], $slot, $day, $classGroup['ClassGroupID']);
          $stmt->execute();
          $stmt->close();
          $assigned = true;
          break 2;
        }
      }
    }
  }

  if (!$assigned) {
    $unscheduledSubjects[] = $subject;
  }
}

// ดึงข้อมูลจากตารางที่เกี่ยวข้อง
$classGroups = $conn->query("SELECT * FROM classgroup")->fetch_all(MYSQLI_ASSOC);
$teachers = $conn->query("SELECT * FROM teachers")->fetch_all(MYSQLI_ASSOC);
$rooms = $conn->query("SELECT * FROM rooms")->fetch_all(MYSQLI_ASSOC);

// ตรวจสอบข้อมูล
echo '<pre>';
echo "จำนวนรายวิชาใน \$scheduleRules: " . count($scheduleRules) . "\n";
print_r($scheduleRules);
echo '</pre>';

// เริ่มกระบวนการลงตารางเรียน
foreach ($scheduleRules as $subject) {
  foreach ($classGroups as $classGroup) {
    foreach ($teachers as $teacher) {
      foreach ($rooms as $room) {
        assignSubject($conn, $subject, $classGroup, $teacher, $room, $unscheduledSubjects);
      }
    }
  }
}

// ตรวจสอบจำนวนวิชาที่บันทึก
$result = $conn->query("SELECT COUNT(*) AS total FROM schedule");
$row = $result->fetch_assoc();
echo "จำนวนรายวิชาที่บันทึกใน schedule: " . $row['total'] . "\n";

// แสดงรายวิชาที่ยังไม่สามารถลงตารางได้
if (!empty($unscheduledSubjects)) {
  echo '<pre>';
  echo "รายวิชาที่ยังไม่สามารถลงตารางได้:\n";
  print_r($unscheduledSubjects);
  echo '</pre>';
} else {
  echo "ลงตารางเรียนสำเร็จทั้งหมด!";
}