<?php
include '../../../../Controller/connect.php';

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

include 'preparedata.php';
include 'createschedule.php';
$ClassGroupName = ['ปวช.1/1', 'ปวช.2/1', 'ปวช.3/1', 'ปวช.3/2', 'ปวส.1/1', 'ปวส.2/1', 'ปวส.2/2'];
// แสดงปุ่มย้อนกลับและถัดไป

// echo '<div class="d-flex justify-content-center gap-3 mb-3">';
// echo '<button class="btn btn-outline-danger w-50" onclick="showSection(\'summary\', \'src/role/Admin/schedule/summary/summary.php\')">ย้อนกลับ</button>';
// echo '<button class="btn btn-outline-success w-50" onclick="showSection(\'saveschedule\', \'src/role/Admin/schedule/saveschedule/saveschedule.php\')">ถัดไป</button>';
// echo '</div>';
// echo
// '<div class="d-flex justify-content-center gap-3 mb-3">
//   <button class="btn btn-success w-50" onclick="showSection(\'createschedule\', \'src/role/Admin/schedule/manageschedule/createschedule.php\')">สร้างแบบจำลองตารางเรียน</button>
//   </div>';



// echo "<pre>";
// print_r($scheduleRules);
// echo "</pre>";

$scheduleData = '';
$scheduleDataExample = [
  [
    'SubjectID' => 151,
    'SubjectCode' => '31910-2003',
    'SubjectName' => 'วิเคราะห์และออกแบบระบบเชิงวัตถุ',
    'ClassGroupName' => 'ปวส.1/1',
    'ClassGroupID' => 19,
    'TheoryHours' => 2,
    'PracticalHours' => 2,
    'CreditHours' => 3,
    'DepartmentID' => 10,
    'DepartmentName' => 'แผนกวิชาเทคโนโลยีธุรกิจดิจิทัล',
    'HeadCount' => 13,
    'StudyPlanID' => 164,
    'Term' => 1,
    'Year' => 2567,
    'AvgWeight' => 5,
    'AvgSubjectType' => 1,
    'AvgTheoryPractice' => 3,
    'AvgEquipmentWeight' => 3,
    'AvgContinuity' => 0.8
  ]
];
