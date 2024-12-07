<?php
include '../../../../Controller/connect.php'; // เชื่อมต่อฐานข้อมูล
include 'preparedata.php'; // โหลดข้อมูล $scheduleRules


// echo '<br>';
// echo '<pre>';
// print_r($scheduleRules);
// echo '</pre>';
?>

<!-- <div id="createschedule1"> -->
<?php
$unscheduledSubjects = []; // ตัวแปรเก็บรายวิชาที่ยังไม่ได้ลงตาราง

// ฟังก์ชันตรวจสอบข้อมูลซ้ำในตาราง schedule
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

// ฟังก์ชันดึงรายวิชาที่ต้องลงเรียนจาก studyplans
function getStudyPlanSubjects($conn, $classGroupID)
{
  $stmt = $conn->prepare("SELECT SubjectID FROM studyplans WHERE ClassGroupID = ?");
  $stmt->bind_param("i", $classGroupID);
  $stmt->execute();
  $result = $stmt->get_result();
  $subjects = [];
  while ($row = $result->fetch_assoc()) {
    $subjects[] = $row['SubjectID'];
  }
  $stmt->close();
  return $subjects;
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

  // ตรวจสอบข้อมูลซ้ำ
  if (isSubjectScheduled($conn, $subject['SubjectID'], $classGroup['ClassGroupID'])) {
    return; // ข้ามรายวิชาที่ถูกบันทึกไปแล้ว
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

  if (!$assigned) {
    $unscheduledSubjects[] = $subject; // เก็บวิชาที่ไม่สามารถลงตารางได้
    echo "ไม่สามารถลงตารางวิชา: " . $subject['SubjectCode'] . " (" . $subject['SubjectName'] . ")\n";
  }
}

// ดึงข้อมูลกลุ่มเรียน
$classGroups = $conn->query("SELECT * FROM classgroup")->fetch_all(MYSQLI_ASSOC);

// ดึงข้อมูลครูและห้องเรียน
$teachers = $conn->query("SELECT * FROM teachers")->fetch_all(MYSQLI_ASSOC);
$rooms = $conn->query("SELECT * FROM rooms")->fetch_all(MYSQLI_ASSOC);

// วนลูปแต่ละกลุ่มเรียนเพื่อลงตาราง
foreach ($classGroups as $classGroup) {
  $studyPlanSubjects = getStudyPlanSubjects($conn, $classGroup['ClassGroupID']); // ดึงรายวิชาที่ต้องลงเรียน

  foreach ($scheduleRules as $subject) {
    if (in_array($subject['SubjectID'], $studyPlanSubjects)) { // ตรวจสอบว่าวิชาอยู่ในแผนการเรียนหรือไม่
      foreach ($teachers as $teacher) {
        foreach ($rooms as $room) {
          assignSubject($conn, $subject, $classGroup, $teacher, $room, $unscheduledSubjects);
        }
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
  echo "<br>";
  echo "ลงตารางเรียนสำเร็จทั้งหมด!";
}

?>
</div>