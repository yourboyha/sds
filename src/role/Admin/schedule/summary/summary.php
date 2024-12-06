<!-- ระดับน้ำหนัก (Weight):
4.50 - 5.00: สูงมาก
3.50 - 4.49: สูง
2.50 - 3.49: ปานกลาง
1.50 - 2.49: ต่ำ
0.00 - 1.49: ต่ำมาก

ระดับประเภทวิชา (SubjectType):
4.50 - 5.00: กิจกรรม/เรียนร่วม
3.50 - 4.49: วิชาสามัญ/เรียนร่วม
2.50 - 3.49: วิชาชีพฝึกงาน
1.50 - 2.49: วิชาชีพ/เรียนร่วม
0.00 - 1.49: วิชาชีพ

ระดับทฤษฎี/ปฏิบัติ (TheoryPractice):
3.50 - 4.00: ท
2.50 - 3.49: ท == ป
1.50 - 2.49: เน้น ป
0.00 - 1.49: ป

ระดับค่าน้ำหนักครุภัณฑ์ (EquipmentWeight):
2.50 - 3.00: สูงมาก
1.50 - 2.49: ปานกลาง
0.00 - 1.49: ต่ำ

แยกคาบเรียนได้ไหม (Continuity):
0.50 - 1.00: ได้ 
0.00 - 0.49: ไม่ได้  -->

<head>
  <link rel="stylesheet" href="../../../../../css/schedulestyles.css">
</head>


<?php
include '../../../../Controller/connect.php';
// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo '<div class="d-flex justify-content-center gap-3 mb-3">';
echo '<button class="btn btn-outline-danger w-50" onclick="showSection(\'teachingaids\', \'src/role/Admin/schedule/teachingaids/teachingaids.php\')">ย้อนกลับ</button>';
echo '<button class="btn btn-outline-success w-50" onclick="showSection(\'manageschedule\', \'src/role/Admin/schedule/manageschedule/manageschedule.php\')">ถัดไป</button>';
echo '</div>';

// SQL Query
$sql = "
SELECT
    cg.ClassGroupName,
    s.SubjectCode,
    s.SubjectName,
    s.TheoryHours,
    s.PracticalHours,
    s.CreditHours,
    FORMAT(AVG(r.Continuity), 2) AS AvgContinuity,
    FORMAT(AVG(r.Weight), 2) AS AvgWeight,
    FORMAT(AVG(r.TheoryPractice), 2) AS AvgTheoryPractice,
    FORMAT(AVG(r.SubjectType), 2) AS AvgSubjectType,
    FORMAT(AVG(r.EquipmentWeight), 2) AS AvgEquipmentWeight
FROM
    StudyPlans sp
JOIN
    ClassGroup cg ON sp.ClassGroupID = cg.ClassGroupID
JOIN
    Subjects s ON sp.SubjectID = s.SubjectID
JOIN
    rules r ON s.SubjectID = r.SubjectID
WHERE
    cg.ClassGroupName IN ('ปวช.1/1', 'ปวช.2/1', 'ปวช.3/1', 'ปวช.3/2', 'ปวส.1/1', 'ปวส.2/1', 'ปวส.2/2')
GROUP BY
    cg.ClassGroupName, s.SubjectCode, s.SubjectName, s.TheoryHours, s.PracticalHours, s.CreditHours
ORDER BY
    cg.ClassGroupName, s.SubjectCode;

";

$result = $conn->query($sql);

// เมนูเลือกระดับชั้น
if ($result->num_rows > 0) {
  echo '<span class="text-dark fw-bold">เลือกระดับชั้น :</span>';
  $menuLinks = "<ul class='nav nav-pills mb-3'>";

  $groupNames = ['ปวช.1/1', 'ปวช.2/1', 'ปวช.3/1', 'ปวช.3/2', 'ปวส.1/1', 'ปวส.2/1', 'ปวส.2/2'];
  foreach ($groupNames as $groupName) {
    $menuLinks .= "<li class='nav-item'>
        <a class='nav-link btn btn-light text-dark' href='#" . urlencode($groupName) . "'>" . $groupName . "</a>
      </li>";
  }
  $menuLinks .= "</ul>";
  echo $menuLinks;
}

// ตัวแปรเก็บกลุ่มเรียนปัจจุบัน
$currentGroup = "";

// เริ่มต้นแสดงข้อมูล
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // หากเปลี่ยนกลุ่มเรียน ให้เริ่มตารางใหม่
    if ($currentGroup !== $row['ClassGroupName']) {
      // ปิดตารางเดิม (ถ้าไม่ใช่กลุ่มแรก)
      if ($currentGroup !== "") {
        echo '</tbody></table>';
      }

      // เริ่มกลุ่มใหม่
      $currentGroup = $row['ClassGroupName'];
      echo "<h3 id='" . urlencode($currentGroup) . "'>{$currentGroup}</h3>";
      echo '
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2">ลำดับ</th>
                        <th rowspan="2">รหัสวิชา</th>
                        <th rowspan="2" class="subjectname">ชื่อวิชา</th>
                        <th rowspan="2">ท</th>
                        <th rowspan="2">ป</th>
                        <th rowspan="2">น</th>
                        <th colspan="2">แยกคาบ</th>
                        <th colspan="2">ความสำคัญ</th>
                        <th colspan="2">ท/ป</th>
                        <th colspan="2">ประเภทวิชา</th>
                        <th colspan="2">วัสดุ/ครุภัณฑ์</th>
                    </tr>
                    <tr>
                        <th>Avg</th>
                        <th>ผล</th>
                        <th>Avg</th>
                        <th>ผล</th>
                        <th>Avg</th>
                        <th>ผล</th>
                        <th>Avg</th>
                        <th>ผล</th>
                        <th>Avg</th>
                        <th>ผล</th>
                    </tr>
                </thead>
                <tbody>';
      $i = 1;
    }

    $AvgPracticalHours = $row['PracticalHours'];
    $AvgTheoryHours = $row['TheoryHours'];
    $AvgEquipmentWeight = $row['AvgEquipmentWeight'];
    $AvgContinuity = $row['AvgContinuity'];
    $AvgWeight = $row['AvgWeight'];
    $AvgSubjectType = $row['AvgSubjectType'];

    $theoryPractice = '';
    $EquipmentWeight = '';
    $Continuity = '';
    $Weight = '';
    $SubjectType = '';

    // คำนวณ TheoryPractice
    if ($AvgTheoryHours > $AvgPracticalHours && $AvgPracticalHours == 0) {
      $theoryPractice = 'ท';
    } elseif ($AvgTheoryHours == 0 && $AvgTheoryHours < $AvgPracticalHours) {
      $theoryPractice = 'ป';
    } elseif ($AvgTheoryHours < $AvgPracticalHours) {
      $theoryPractice = 'เน้น ป';
    } elseif ($AvgTheoryHours == $AvgPracticalHours) {
      $theoryPractice = 'ท == ป';
    }
    // ตรวจสอบระดับค่าน้ำหนักครุภัณฑ์ (EquipmentWeight)
    if ($AvgEquipmentWeight >= 2.50 && $AvgEquipmentWeight <= 3.00) {
      $EquipmentWeight = 'สูง';
    } elseif ($AvgEquipmentWeight >= 1.50 && $AvgEquipmentWeight <= 2.49) {
      $EquipmentWeight = 'ปานกลาง';
    } else {
      $EquipmentWeight = 'ต่ำ';
    }
    // ตรวจสอบแยกคาบเรียนได้ไหม (Continuity)
    if ($AvgContinuity >= 0.50 && $AvgContinuity <= 1.00) {
      $Continuity = 'ได้';
    } else {
      $Continuity = 'ไม่ได้';
    }
    // ตรวจสอบระดับน้ำหนัก (Weight)
    if ($AvgWeight >= 4.50 && $AvgWeight <= 5.00) {
      $Weight = 'สูงมาก';
    } elseif ($AvgWeight >= 3.50 && $AvgWeight <= 4.49) {
      $Weight = 'สูง';
    } elseif ($AvgWeight >= 2.50 && $AvgWeight <= 3.49) {
      $Weight = 'ปานกลาง';
    } elseif ($AvgWeight >= 1.50 && $AvgWeight <= 2.49) {
      $Weight = 'ต่ำ';
    } else {
      $Weight = 'ต่ำมาก';
    }
    // ตรวจสอบระดับประเภทวิชา (SubjectType)
    if ($AvgSubjectType >= 4.50 && $AvgSubjectType <= 5.00) {
      $SubjectType = 'กิจกรรม/เรียนร่วม';
    } elseif (
      $AvgSubjectType >= 3.50 && $AvgSubjectType <= 4.49
    ) {
      $SubjectType = 'วิชาสามัญ/เรียนร่วม';
    } elseif (
      $AvgSubjectType >= 2.50 && $AvgSubjectType <= 3.49
    ) {
      $SubjectType = 'วิชาชีพฝึกงาน';
    } elseif (
      $AvgSubjectType >= 1.50 && $AvgSubjectType <= 2.49
    ) {
      $SubjectType = 'วิชาชีพ/เรียนร่วม';
    } else {
      $SubjectType = 'วิชาชีพ';
    }

    // แสดงข้อมูลในแถว
    echo '<tr>';
    echo "<td>{$i}</td>";
    echo "<td class='day-name'>{$row['SubjectCode']}</td>";
    echo "<td class='day-name text-start'>{$row['SubjectName']}</td>";
    echo "<td class='day-name'>{$row['TheoryHours']}</td>";
    echo "<td class='day-name'>{$row['PracticalHours']}</td>";
    echo "<td class='day-name'>{$row['CreditHours']}</td>";


    // FORMAT(AVG(r.Continuity), 2) AS AvgContinuity,
    // FORMAT(AVG(r.Weight), 2) AS AvgWeight,
    // FORMAT(AVG(r.TheoryPractice), 2) AS AvgTheoryPractice,
    // FORMAT(AVG(r.SubjectType), 2) AS AvgSubjectType,
    // FORMAT(AVG(r.EquipmentWeight), 2) AS AvgEquipmentWeight

    echo "<td class='day-name'>{$row['AvgContinuity']}</td>";
    echo "<td class='day-name'>$Continuity</td>";
    // echo '<td><input type="checkbox" ' . ($row['Continuity'] ? 'checked' : '') . ' style="pointer-events: none;"></td>';
    echo "<td class='day-name'>{$row['AvgWeight']}</td>";
    echo "<td class='day-name'>$Weight</td>";

    echo "<td class='day-name'>" . $row['AvgTheoryPractice'] . "</td>";
    echo "<td class='day-name'>$theoryPractice</td>";
    echo "<td class='day-name'>" . $row['AvgSubjectType'] . "</td>";
    // <select id="subjecttype" name="subjecttype" class="form-select" disabled>
    //     <option value="1" ' . ($row['SubjectType'] == 1 ? 'selected' : '') . '>วิชาชีพ</option>
    //     <option value="2" ' . ($row['SubjectType'] == 2 ? 'selected' : '') . '>วิชาชีพ/เรียนร่วม</option>
    //     <option value="3" ' . ($row['SubjectType'] == 3 ? 'selected' : '') . '>วิชาชีพฝึกงาน</option>
    //     <option value="4" ' . ($row['SubjectType'] == 4 ? 'selected' : '') . '>วิชาสามัญ/เรียนร่วม</option>
    //     <option value="5" ' . ($row['SubjectType'] == 5 ? 'selected' : '') . '>กิจกรรม/เรียนร่วม</option>
    // </select>
    echo "<td class='day-name'>$SubjectType</td>";
    echo "<td class='day-name'>" . $row['AvgEquipmentWeight'] . "</td>";
    // <select id="courseDropdown" name="courseCategory" class="form-select" disabled>
    //     <option value="1" ' . ($row['EquipmentWeight'] == 1 ? 'selected' : '') . '>1</option>
    //     <option value="2" ' . ($row['EquipmentWeight'] == 2 ? 'selected' : '') . '>2</option>
    //     <option value="3" ' . ($row['EquipmentWeight'] == 3 ? 'selected' : '') . '>3</option>
    // </select>
    echo "<td class='day-name'>$EquipmentWeight</td>";
    echo '</tr>';

    $i++;
  }

  // ปิดตารางสุดท้าย
  echo '</tbody></table>';
} else {
  echo '<div class="alert alert-warning">ไม่มีข้อมูล</div>';
}

// ปิดการเชื่อมต่อ
$conn->close();