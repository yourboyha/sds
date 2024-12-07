<?php
// เชื่อมต่อฐานข้อมูล
$pdo = new PDO('mysql:host=localhost;dbname=your_database_name', 'username', 'password');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ฟังก์ชันช่วยเหลือ
function isTimeSlotAvailable($pdo, $day, $timeSlot, $roomID, $classGroupID)
{
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM schedule WHERE DayOfWeek = ? AND TimeSlot = ? AND (RoomID = ? OR ClassGroupID = ?)");
  $stmt->execute([$day, $timeSlot, $roomID, $classGroupID]);
  return $stmt->fetchColumn() == 0;
}

// ฟังก์ชันลงรายวิชา
function assignSubject($pdo, $subject, $classGroup, $teacher, $room, &$unscheduledSubjects)
{
  $days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
  $timeSlots = [
    '1-4' => ['mon1-mon4', 'tue1-tue4', 'wed1-wed4', 'thu1-thu4', 'fri1-fri4'],
    '6-9' => ['mon6-mon9', 'tue6-tue9', 'wed6-wed9', 'thu6-thu9', 'fri6-fri9']
  ];

  $assigned = false;

  foreach ($days as $day) {
    foreach ($timeSlots as $key => $slots) {
      if ($key == '1-4' && isTimeSlotAvailable($pdo, $day, $slots[0], $room['RoomID'], $classGroup['ClassGroupID'])) {
        $stmt = $pdo->prepare("INSERT INTO schedule (SubjectID, TeacherID, RoomID, TimeSlot, DayOfWeek, ClassGroupID) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
          $subject['SubjectID'],
          $teacher['TeacherID'],
          $room['RoomID'],
          $slots[0],
          $day,
          $classGroup['ClassGroupID']
        ]);
        $assigned = true;
        break;
      }
    }
    if ($assigned) break;
  }

  if (!$assigned) {
    $unscheduledSubjects[] = $subject;
  }
}

// ดึงข้อมูลที่เกี่ยวข้อง
$subjects = $pdo->query("SELECT * FROM subjects")->fetchAll(PDO::FETCH_ASSOC);
$classGroups = $pdo->query("SELECT * FROM classgroup")->fetchAll(PDO::FETCH_ASSOC);
$teachers = $pdo->query("SELECT * FROM teachers")->fetchAll(PDO::FETCH_ASSOC);
$rooms = $pdo->query("SELECT * FROM rooms")->fetchAll(PDO::FETCH_ASSOC);

// ตัวแปรเก็บรายวิชาที่ไม่สามารถลงได้
$unscheduledSubjects = [];

// วนลูปเพื่อลงตาราง
foreach ($subjects as $subject) {
  foreach ($classGroups as $classGroup) {
    foreach ($teachers as $teacher) {
      foreach ($rooms as $room) {
        assignSubject($pdo, $subject, $classGroup, $teacher, $room, $unscheduledSubjects);
      }
    }
  }
}

// แสดงผลรายวิชาที่ยังไม่สามารถลงตารางได้
if (!empty($unscheduledSubjects)) {
  echo "รายวิชาที่ยังไม่สามารถลงตารางได้:\n";
  foreach ($unscheduledSubjects as $subject) {
    echo "- " . $subject['SubjectCode'] . " (" . $subject['SubjectName'] . ")\n";
  }
} else {
  echo "ลงตารางเรียนสำเร็จทั้งหมด!";
}