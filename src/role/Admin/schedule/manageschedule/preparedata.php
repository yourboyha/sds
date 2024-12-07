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
    AVG(r.Weight) AS AvgWeight,
    AVG(r.SubjectType) AS AvgSubjectType,
    AVG(r.TheoryPractice) AS AvgTheoryPractice,
    AVG(r.EquipmentWeight) AS AvgEquipmentWeight,
    AVG(r.Continuity) AS AvgContinuity
FROM rules r
JOIN subjects s ON r.SubjectID = s.SubjectID
GROUP BY r.SubjectID, s.SubjectCode
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

// แสดงข้อมูลในตัวแปร (เพื่อ Debug)
// echo "<pre>";
// print_r($scheduleRules);
// echo "</pre>";

//  ปิดการเชื่อมต่อฐานข้อมูล
// $conn->close();