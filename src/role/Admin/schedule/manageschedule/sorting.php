<?php
// ตัวอย่างข้อมูลวิชา
$subjects = [
  ["SubjectCode" => "20204-2106", "Weight" => 4.6, "EquipmentWeight" => 3.0, "SubjectType" => 2.4, "TheoryPractice" => "ท == ป", "Continuity" => 0.4],
  ["SubjectCode" => "20204-2110", "Weight" => 4.4, "EquipmentWeight" => 2.6, "SubjectType" => 2.0, "TheoryPractice" => "ป", "Continuity" => 0.2],
  ["SubjectCode" => "20204-2111", "Weight" => 4.6, "EquipmentWeight" => 2.4, "SubjectType" => 2.8, "TheoryPractice" => "ท", "Continuity" => 0.0],
];

// ฟังก์ชันเรียงลำดับ
usort($subjects, function ($a, $b) {
  // เปรียบเทียบ Weight
  if ($a['Weight'] != $b['Weight']) {
    return $b['Weight'] <=> $a['Weight'];
  }
  // เปรียบเทียบ EquipmentWeight
  if ($a['EquipmentWeight'] != $b['EquipmentWeight']) {
    return $b['EquipmentWeight'] <=> $a['EquipmentWeight'];
  }
  // เปรียบเทียบ SubjectType
  if ($a['SubjectType'] != $b['SubjectType']) {
    return $b['SubjectType'] <=> $a['SubjectType'];
  }
  // เปรียบเทียบ TheoryPractice (สมมติใช้ตัวอักษรเปรียบเทียบ)
  return strcmp($a['TheoryPractice'], $b['TheoryPractice']);
});

// แสดงผลวิชาที่เรียงลำดับแล้ว
print_r($subjects);