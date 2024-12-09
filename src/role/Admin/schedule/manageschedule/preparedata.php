<?php
// include '../../../../Controller/connect.php';

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL สำหรับดึงข้อมูลตาม Rules
$sql = "
SELECT 
    r.SubjectID,
    s.SubjectCode,
    s.SubjectName,
    cg.ClassGroupName,
    cg.ClassGroupID,
    s.TheoryHours,
    s.PracticalHours,
    s.CreditHours,
    d.DepartmentID,
    d.DepartmentName,
    cg.HeadCount, 
    sp.StudyPlanID,
    sp.Term,
    sp.Year + 543 AS Year, -- ปรับปี พ.ศ.
    AVG(r.Weight) AS AvgWeight,
    AVG(r.SubjectType) AS AvgSubjectType,
    AVG(r.TheoryPractice) AS AvgTheoryPractice,
    AVG(r.EquipmentWeight) AS AvgEquipmentWeight,
    AVG(r.Continuity) AS AvgContinuity
FROM rules r
LEFT JOIN subjects s ON r.SubjectID = s.SubjectID
LEFT JOIN studyplans sp ON r.SubjectID = sp.SubjectID
LEFT JOIN classgroup cg ON sp.ClassGroupID = cg.ClassGroupID
LEFT JOIN departments d ON cg.DepartmentID = d.DepartmentID 
GROUP BY 
    r.SubjectID, 
    s.SubjectCode, 
    cg.ClassGroupName,
    s.TheoryHours, 
    s.PracticalHours, 
    s.CreditHours, 
    d.DepartmentName, 
    sp.Term, 
    sp.Year
ORDER BY 
    AvgWeight DESC,          -- ลำดับที่ 1: ความสำคัญของวิชามากที่สุด
    AvgEquipmentWeight DESC, -- ลำดับที่ 2: อุปกรณ์สำคัญที่สุด
    AvgSubjectType DESC,     -- ลำดับที่ 3: ประเภทวิชาที่สำคัญ
    AvgTheoryPractice DESC,  -- ลำดับที่ 4: ความสมดุลทฤษฎีและปฏิบัติ
    AvgContinuity DESC;      -- ลำดับที่ 5: แยกคาบได้ดีที่สุด

";

// ดึงข้อมูลจากฐานข้อมูล
$result = $conn->query($sql);

// ตัวแปรสำหรับเก็บข้อมูล
$scheduleRules = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $scheduleRules[] = [
      'SubjectID' => $row['SubjectID'],
      'SubjectCode' => $row['SubjectCode'],
      'SubjectName' => $row['SubjectName'],
      'ClassGroupName' => $row['ClassGroupName'],
      'ClassGroupID' => $row['ClassGroupID'],
      'TheoryHours' => (int)$row['TheoryHours'],
      'PracticalHours' => (int)$row['PracticalHours'],
      'CreditHours' => (int)$row['CreditHours'],
      'DepartmentID' => $row['DepartmentID'],
      'DepartmentName' => $row['DepartmentName'],
      'HeadCount' => (int)$row['HeadCount'],
      'StudyPlanID' => $row['StudyPlanID'],
      'Term' => (int)$row['Term'],
      'Year' => (int)$row['Year'], // ปีที่ถูกปรับเป็น พ.ศ.
      'AvgWeight' => (float)$row['AvgWeight'],
      'AvgSubjectType' => (float)$row['AvgSubjectType'],
      'AvgTheoryPractice' => (float)$row['AvgTheoryPractice'],
      'AvgEquipmentWeight' => (float)$row['AvgEquipmentWeight'],
      'AvgContinuity' => (float)$row['AvgContinuity']
    ];
  }
} else {
  echo "ไม่มีข้อมูลตามเงื่อนไข Rules";
  exit;
}

function showscheduleRules($scheduleRules)
{
?>
  <h4>ลำดับการจัดตารางเรียน</h4>
  <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
      <thead class="class-slot75">
        <tr>
          <th>id</th>
          <th>รหัสวิชา</th>
          <th>ชื่อวิชา</th>
          <th>กลุ่มเรียน</th>
          <th>ท</th>
          <th>ป</th>
          <th>น</th>
          <th>แผนกวิชา</th>
          <th>จำนวนคน</th>
          <th>ภาคเรียน/ปีการศึกษา</th>
          <th>น้ำหนัก</th>
          <th>ประเภทวิชา</th>
          <th>ท/ป</th>
          <th>วัสดุ/ครภัณฑ์</th>
          <th>แยกคาบ</th>
        </tr>
      </thead>
      <tbody class="class-slot75">
        <?php foreach ($scheduleRules as $rule) { ?>
          <tr>
            <td><?php echo $rule['SubjectID']; ?></td>
            <td><?php echo $rule['SubjectCode']; ?></td>
            <td class="text-start"><?php echo $rule['SubjectName']; ?></td>
            <td><?php echo $rule['ClassGroupName']; ?></td>
            <td><?php echo $rule['TheoryHours']; ?></td>
            <td><?php echo $rule['PracticalHours']; ?></td>
            <td><?php echo $rule['CreditHours']; ?></td>
            <td><?php echo $rule['DepartmentName']; ?></td>
            <td><?php echo $rule['HeadCount']; ?></td>
            <td><?php echo $rule['Term'] . '/' . $rule['Year']; ?></td>
            <td><?php echo $rule['AvgWeight']; ?></td>
            <td><?php echo $rule['AvgSubjectType']; ?></td>
            <td><?php echo $rule['AvgTheoryPractice']; ?></td>
            <td><?php echo $rule['AvgEquipmentWeight']; ?></td>
            <td><?php echo $rule['AvgContinuity']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
<?php
}


// แสดงข้อมูลในตัวแปร (เพื่อ Debug)
// echo "<pre>";
// print_r($scheduleRules);
// echo "</pre>";

// ปิดการเชื่อมต่อฐานข้อมูล
// $conn->close();
?>