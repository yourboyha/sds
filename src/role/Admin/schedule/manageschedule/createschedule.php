<?php
include '../../../../Controller/connect.php';
include 'preparedata.php'; // โหลดข้อมูล $scheduleRules

// แสดงข้อมูลในตัวแปร (เพื่อ Debug)
// echo "<pre>";
// print_r($scheduleRules);
// echo "</pre>";

$unscheduledSubjects = []; // เก็บรายวิชาที่ยังไม่สามารถลงตารางได้

// ดึงข้อมูลที่จำเป็น
$classGroups = $conn->query("SELECT * FROM classgroup")->fetch_all(MYSQLI_ASSOC);
$teachers = $conn->query("SELECT * FROM teachers")->fetch_all(MYSQLI_ASSOC);
$rooms = $conn->query("SELECT * FROM rooms")->fetch_all(MYSQLI_ASSOC);
$subjects = $conn->query("SELECT * FROM subjects")->fetch_all(MYSQLI_ASSOC);
$studyPlans = $conn->query("SELECT * FROM studyplans")->fetch_all(MYSQLI_ASSOC);
$departments = $conn->query("SELECT * FROM departments")->fetch_all(MYSQLI_ASSOC);

// สร้าง Mapping สำหรับ Departments
$departmentMap = [];
foreach ($departments as $department) {
  $departmentMap[$department['DepartmentID']] = $department['DepartmentName'];
}

// ฟังก์ชันช่วย (Helper Functions)
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

function getTeacherForSubject($teachers, $departmentID, $specialization, $conn)
{
  foreach ($teachers as $teacher) {
    if ($teacher['DepartmentID'] == $departmentID && $teacher['Specialization'] === $specialization) {
      // ดึง FullName จากตาราง users
      $stmt = $conn->prepare("SELECT FullName FROM users WHERE UserID = ?");
      $stmt->bind_param("i", $teacher['UserID']);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $teacher['FullName'] = $row['FullName'] ?? 'ไม่ทราบชื่อครู';
      $stmt->close();

      return $teacher;
    }
  }
  return null;
}


function getRoomForSubject($rooms, $departmentID)
{
  foreach ($rooms as $room) {
    if ($room['DepartmentID'] == $departmentID) {
      return $room;
    }
  }
  return null;
}

function assignSubject($conn, $subject, $classGroup, $teacher, $room, &$unscheduledSubjects, $prioritySlots)
{
  $days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
  $assigned = false;

  // Debug: ตรวจสอบคีย์ก่อนใช้งาน
  $subjectID = $subject['SubjectID'] ?? 'ไม่ทราบ';
  $subjectName = $subject['SubjectName'] ?? 'ไม่ทราบชื่อวิชา';
  $classGroupName = $classGroup['ClassGroupName'] ?? 'ไม่ทราบชื่อกลุ่มเรียน';
  $teacherName = $teacher['FullName'] ?? 'ไม่ทราบชื่อครู';
  $roomName = $room['RoomName'] ?? 'ไม่ทราบชื่อห้อง';

  echo "<pre>";
  echo "Assigning Subject: $subjectID ($subjectName)\n";
  echo "ClassGroup: $classGroupName\n";
  echo "Teacher: $teacherName (ID: " . ($teacher['TeacherID'] ?? 'ไม่ทราบ') . ")\n";
  echo "Room: $roomName (ID: " . ($room['RoomID'] ?? 'ไม่ทราบ') . ")\n";
  echo "Priority Slots: ";
  print_r($prioritySlots);
  echo "</pre>";

  // ตรวจสอบข้อมูลวิชา
  foreach ($days as $day) {
    foreach ($prioritySlots as $slot) {
      echo "Checking Day: $day, Slot: $slot\n";

      if (isTimeSlotAvailable($conn, $day, $slot, $room['RoomID'] ?? 0, $classGroup['ClassGroupID'] ?? 0)) {

        echo "Assigning to Day: $day, Slot: $slot\n";
        echo '<br>';

        // กำหนดค่าให้แน่ใจว่าค่าเป็นประเภทที่ถูกต้อง
        $subjectID = (int)$subject['SubjectID'];
        $teacherID = (int)($teacher['TeacherID'] ?? 0);
        $roomID = (int)($room['RoomID'] ?? 0);
        $timeSlot = (string)$slot;
        $classGroupID = (int)($classGroup['ClassGroupID'] ?? 0);


        $stmt = $conn->prepare("INSERT INTO schedule (SubjectID, TeacherID, RoomID, TimeSlot, DayOfWeek, ClassGroupID) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiissi", $subjectID, $teacherID, $roomID, $timeSlot, $day, $classGroupID);

        if ($stmt->execute()) {
          echo "Subject Assigned: $subjectID to $day, Slot: $slot\n";
        } else {
          echo "Error Assigning Subject: " . $stmt->error . "\n";
        }

        // ตรวจสอบการบันทึก
        if ($stmt->execute()) {
          echo "Subject Assigned: $subjectID to $day, Slot: $slot\n";
        } else {
          echo "Error Assigning Subject: " . $stmt->error . "\n";
        }
        $stmt->close();
        $assigned = true;
        break 2;
      } else {
        echo "Not Available: $day, Slot: $slot\n";
      }
    }
  }

  // หากไม่สามารถลงตารางได้
  if (!$assigned) {
    $unscheduledSubjects[] = $subject;
    echo "Unscheduled Subject: $subjectID ($subjectName)\n";
  }
}




// echo '<pre>';
// print_r($departmentMap);
// echo '</pre>';

// echo '<pre>';
// print_r($subjects);
// echo '</pre>';

// echo '<pre>';
// print_r($teachers);
// echo '</pre>';


// ตรวจสอบข้อมูลที่ไม่สัมพันธ์กัน
echo '<pre>';
foreach ($subjects as $subject) {
  if (!isset($subject['DepartmentID']) || empty($subject['DepartmentID'])) {
    echo "SubjectID: " . $subject['SubjectID'] . " ไม่มี DepartmentID\n";
  }
}

foreach ($rooms as $room) {
  if (!isset($room['DepartmentID']) || empty($room['DepartmentID'])) {
    echo "RoomID: " . $room['RoomID'] . " ไม่มี DepartmentID\n";
  }
}

foreach ($teachers as $teacher) {
  if (!isset($teacher['DepartmentID']) || empty($teacher['DepartmentID'])) {
    echo "TeacherID: " . $teacher['TeacherID'] . " ไม่มี DepartmentID\n";
  }
}
echo '</pre>';



// กระบวนการหลัก (Main Process)
foreach ($scheduleRules as $subject) { // เรียงตาม $scheduleRules
  foreach ($classGroups as $classGroup) {
    if (!isset($classGroup['DepartmentID'])) {
      echo "ไม่มี DepartmentID สำหรับ ClassGroupID: " . $classGroup['ClassGroupID'] . "\n";
      continue;
    }

    foreach ($studyPlans as $studyPlan) {
      if ($studyPlan['SubjectID'] == $subject['SubjectID'] && $studyPlan['ClassGroupID'] == $classGroup['ClassGroupID']) {
        // ดึง SubjectName จาก subjects
        $stmt = $conn->prepare("SELECT SubjectName, DepartmentID  FROM subjects WHERE SubjectID = ?");
        $stmt->bind_param("i", $subject['SubjectID']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $subject['SubjectName'] = $row['SubjectName'] ?? 'ไม่ทราบชื่อวิชา';
        $subject['DepartmentID'] = $row['DepartmentID'] ?? null;
        $stmt->close();


        $departmentID = $classGroup['DepartmentID'];
        $specialization = $departmentID == 11 ? 'Samun' : 'Computer';

        // ดึงข้อมูลครู (พร้อม FullName)
        $teacher = getTeacherForSubject($teachers, $departmentID, $specialization, $conn);
        if ($teacher) {
          // ดึง FullName จากตาราง users
          $stmt = $conn->prepare("SELECT FullName FROM users WHERE UserID = ?");
          $stmt->bind_param("i", $teacher['UserID']);
          $stmt->execute();
          $result = $stmt->get_result();
          $userRow = $result->fetch_assoc();
          $teacher['FullName'] = $userRow['FullName'] ?? 'ไม่ทราบชื่อครู';
          $stmt->close();
        }

        $room = getRoomForSubject($rooms, $departmentID);

        // Debugging ข้อมูล
        echo '<pre>';
        echo "Subject Details:\n";
        print_r($subject);
        echo "Teacher Details:\n";
        print_r($teacher);
        echo "Room Details:\n";
        print_r($room);
        echo '</pre>';

        // ถ้าหาครูหรือห้องไม่ได้ให้ข้ามไป
        if (!$teacher || !$room) {
          $unscheduledSubjects[] = $subject;
          echo "หาไม่เจอนะ: SubjectID " . $subject['SubjectID'] . "\n";
          continue;
        }

        // จัดลำดับความสำคัญของ TimeSlot
        $prioritySlots = $subject['AvgContinuity'] > 0.5 ? ['4', '9', '10-12'] : ['1-4', '6-9'];
        assignSubject($conn, $subject, $classGroup, $teacher, $room, $unscheduledSubjects, $prioritySlots);
      }
    }
  }
}



echo '<pre>';
echo 'มาจากunscheduledSubjects';
print_r(
  $unscheduledSubjects
);
echo '</pre>';



// แสดงผลลัพธ์
if (!empty($unscheduledSubjects)) {
  echo '<pre>';
  echo "รายวิชาที่ยังไม่สามารถลงตารางได้:\n";
  foreach ($unscheduledSubjects as $subject) {
    $subjectName = $subject['SubjectName'] ?? 'ไม่ทราบชื่อวิชา';
    $subjectCode = $subject['SubjectCode'] ?? 'ไม่ทราบรหัสวิชา';
    $departmentID = $subject['DepartmentID'] ?? 'ไม่ทราบ';
    $departmentName = $departmentMap[$departmentID] ?? 'ไม่ทราบแผนก';

    echo "Subject: " . $subjectName . " (" . $subjectCode . "), Department: " . $departmentName . "\n";
  }
  echo '</pre>';
} else {
  echo "ลงตารางเรียนสำเร็จทั้งหมด!";
}