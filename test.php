<?php
// 1. ข้อมูลรายวิชา
$subjects = [
  [
    "name" => "ภาษาไทยเพื่ออาชีพ",
    "weight" => 4.7,
    "subjectType" => 3.8,
    "theoryPractice" => 3.5,
    "equipmentWeight" => 2.7,
    "continuity" => 0.9
  ],
  [
    "name" => "วิเคราะห์ความต้องการทางธุรกิจ",
    "weight" => 4.2,
    "subjectType" => 2.8,
    "theoryPractice" => 2.4,
    "equipmentWeight" => 1.8,
    "continuity" => 0.4
  ],
  // เพิ่มข้อมูลรายวิชาอื่น ๆ
];

// 2. ตารางเรียน
$timeSlots = [
  "Monday" => ["Morning" => null, "Afternoon" => null],
  "Tuesday" => ["Morning" => null, "Afternoon" => null],
  // เพิ่มวันอื่น ๆ
];

// 3. ฟังก์ชันตรวจสอบห้องเรียนที่เหมาะสม
function findAvailableSlot($subject, &$timeSlots)
{
  foreach ($timeSlots as $day => $slots) {
    foreach ($slots as $time => $currentSubject) {
      if ($currentSubject === null) {
        // ตรวจสอบ Continuity
        if ($subject['continuity'] < 0.5) {
          if (!is_null($timeSlots[$day]['Morning']) || !is_null($timeSlots[$day]['Afternoon'])) {
            continue;
          }
        }
        $timeSlots[$day][$time] = $subject['name'];
        return true;
      }
    }
  }
  return false;
}

// 4. การจัดตารางเรียน
foreach ($subjects as $subject) {
  if (!findAvailableSlot($subject, $timeSlots)) {
    echo "Cannot find a suitable time slot for: " . $subject['name'] . "\n";
  }
}

// 5. แสดงตารางเรียน
print_r($timeSlots);