<?php
include '../../../../Controller/connect.php'; // เชื่อมต่อฐานข้อมูล
include 'preparedata.php'; // โหลดข้อมูล $scheduleRules

// แสดงข้อมูลในตัวแปร (เพื่อ Debug)
// echo '<pre>';
// echo "Total records in \$scheduleRules: " . count($scheduleRules) . "\n\n";
// print_r($scheduleRules);
// echo '</pre>';

// ตัวแปรสำหรับเก็บวิชาที่ยังไม่สามารถลงได้
$unscheduledSubjects = [];

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

  // จัดการวิชาชั่วโมง 3-4 ชั่วโมง
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

  // จัดการ Continuity > 0.5
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

  // เก็บรายวิชาที่ยังลงไม่ได้
  if (!$assigned) {
    $unscheduledSubjects[] = $subject;
  }
}

// ดึงข้อมูลจากตารางที่เกี่ยวข้อง
$classGroups = $conn->query("SELECT * FROM classgroup")->fetch_all(MYSQLI_ASSOC);
$teachers = $conn->query("SELECT * FROM teachers")->fetch_all(MYSQLI_ASSOC);
$rooms = $conn->query("SELECT * FROM rooms")->fetch_all(MYSQLI_ASSOC);

// วนลูปเพื่อลงตารางเรียน
foreach ($scheduleRules as $subject) {
  foreach ($classGroups as $classGroup) {
    foreach ($teachers as $teacher) {
      foreach ($rooms as $room) {
        assignSubject($conn, $subject, $classGroup, $teacher, $room, $unscheduledSubjects);
      }
    }
  }
}

// แสดงรายวิชาที่ยังไม่สามารถลงตารางได้
if (!empty($unscheduledSubjects)) {
  echo "รายวิชาที่ยังไม่สามารถลงตารางได้:\n";
  foreach ($unscheduledSubjects as $subject) {
    echo "- " . $subject['SubjectCode'] . " (" . $subject['SubjectName'] . ")\n";
  }
} else {
  echo "ลงตารางเรียนสำเร็จทั้งหมด!";
}
echo 'ทำการบันทึกข้อมูลแล้ว';
echo '<br>';
echo 'คงเหลือรายวิชาที่ไม่สามารถจัดได้ ดังนี้ ';
echo '<br>';
echo '<pre></pre>';
print_r($unscheduledSubjects);
echo '</pre>';