<?php
include '../../../../Controller/connect.php';

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

include 'Function_schedule.php';
include 'FunctionSubject.php';
// แสดงปุ่มย้อนกลับและถัดไป
function renderNavigationButtons()
{
  echo '<div class="d-flex justify-content-center gap-3 mb-3">';
  echo '<button class="btn btn-outline-danger w-50" onclick="showSection(\'summary\', \'src/role/Admin/schedule/summary/summary.php\')">ย้อนกลับ</button>';
  echo '<button class="btn btn-outline-success w-50" onclick="showSection(\'saveschedule\', \'src/role/Admin/schedule/saveschedule/saveschedule.php\')">ถัดไป</button>';
  echo '</div>';
  echo
  '<div class="d-flex justify-content-center gap-3 mb-3">
  <button class="btn btn-success w-50" onclick="showSection(\'createschedule\', \'src/role/Admin/schedule/manageschedule/createschedule.php\')">สร้างแบบจำลองตารางเรียน</button>
  </div>';
}

$scheduleDataExample = [
  [
    "ScheduleID" => 52941,
    "SubjectName" => "การเขียนโปรแกรมภาษาคอมพิวเตอร์",
    "SubjectCode" => "21910-2010",
    "TeacherName" => "นายวุฒิพงศ์ วิมลพัชร",
    "RoomName" => "Lab1",
    "TimeSlot" => "6-9",
    "DayOfWeek" => "fri",
    "ClassGroupName" => "ปวช.1/1",
    "Term" => 2
  ]
];


// การทำงานหลัก
renderNavigationButtons();
// เรียกข้อมูลจากฟังก์ชัน
$scheduleData = getScheduleData($conn);
renderScheduleTable($scheduleData, 'ปวช.1/1');
showSubject($conn);