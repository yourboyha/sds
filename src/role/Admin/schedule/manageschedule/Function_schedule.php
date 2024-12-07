<?php
// แสดงลิงก์เมนูสำหรับเปลี่ยนกลุ่ม
function renderMenuLinks($currentGroup)
{
  $groupNames = ['ปวช.1/1', 'ปวช.2/1', 'ปวช.3/1', 'ปวช.3/2', 'ปวส.1/1', 'ปวส.2/1', 'ปวส.2/2'];

  echo "<ul class='nav nav-pills mb-3'>";
  foreach ($groupNames as $groupName) {
    $activeClass = ($currentGroup === $groupName) ? 'active' : '';
    echo "<li class='nav-item'>
      <a class='nav-link btn btn-light text-dark $activeClass' href='?group=" . urlencode($groupName) . "'>$groupName</a>
    </li>";
  }
  echo "</ul>";
}


// ดึงข้อมูลตารางเรียน
function getScheduleData($conn)
{
  $sql =
    "
SELECT 
    sc.ScheduleID,
    s.SubjectName,
    s.SubjectCode,
    u.FullName AS TeacherName,
    r.RoomName,
    sc.TimeSlot,
    sc.DayOfWeek,
    cg.ClassGroupName,
    sp.Term
FROM schedule sc
JOIN subjects s ON sc.SubjectID = s.SubjectID
JOIN rooms r ON sc.RoomID = r.RoomID
JOIN teachers t ON sc.TeacherID = t.TeacherID
JOIN users u ON t.UserID = u.UserID
JOIN classgroup cg ON sc.ClassGroupID = cg.ClassGroupID
JOIN studyplans sp ON sc.ClassGroupID = sp.ClassGroupID AND sc.SubjectID = sp.SubjectID
ORDER BY sc.ClassGroupID, sc.DayOfWeek, sc.TimeSlot;

";
  // ดำเนินการ SQL
  $result = $conn->query($sql);

  // ตรวจสอบว่ามีข้อมูลหรือไม่
  if ($result && $result->num_rows > 0) {
    return $result->fetch_all(MYSQLI_ASSOC); // ดึงข้อมูลทั้งหมดในรูปแบบ associative array
  } else {
    return []; // กรณีไม่มีข้อมูล
  }

  // ตรวจสอบและแสดงผลข้อมูล
  // if (!empty($scheduleData)) {
  // echo "<pre>";
  // print_r($scheduleData);
  // echo "</pre>";
  // } else {
  //   echo "ไม่มีข้อมูลในตาราง schedule";
  // }
}

// แสดงตารางเรียน
function renderScheduleTable($scheduleData)
{

  $timeSlots = [
    "07:40<br>08:00",
    "08:00<br>09:15",
    "09:15<br>10:15",
    "10:15<br>11:15",
    "11:15<br>12:15",
    "12:15<br>13:00",
    "13:00<br>14:00",
    "14:00<br>15:00",
    "15:00<br>16:00",
    "16:00<br>17:00",
    "17:00<br>18:00",
    "18:00<br>19:00",
    "19:00<br>20:00",
  ];

  $days = ['mon' => 'วันจันทร์', 'tue' => 'วันอังคาร', 'wed' => 'วันพุธ', 'thu' => 'วันพฤหัสบดี', 'fri' => 'วันศุกร์'];

  echo '<div class="container content">';
  echo '<h2 class="text-center mb-2">ตารางเรียน</h2>';
  echo '<table class="container table table-bordered table-striped table-hover text-center">';
  echo '<thead class="table-info">
      <tr>
        <th>เวลา</th>';

  // ใช้การวนลูปแสดงช่วงเวลา
  foreach ($timeSlots as $slot) {
    echo "<th class='timeslot'>$slot</th>";
  }
  echo '   </tr>
    </thead>
    <tbody>';

  echo "<tr>";
  echo "<td>วัน/คาบ</td>";
  echo '<td rowspan="6" class="vertical-text day-name">กิจกรรมหน้าเสาธง</td>';
  for ($slot = 1; $slot <= 12; $slot++) {
    echo "<td class='timeslot'>คาบที่ $slot</td>";
  }
  echo "</tr>";
  foreach ($days as $dayCode => $dayName) {

    echo "<tr>
        <td class='day-name'>$dayName</td>";
    for ($slot = 1; $slot <= 12; $slot++) {
      $cellContent = ($dayCode === 'thu' && $slot === 6) ? 'Home<br>room' : (
        isset($scheduleData[$dayCode][$slot]) ? $scheduleData[$dayCode][$slot]['SubjectCode'] . '<br>' .
        $scheduleData[$dayCode][$slot]['RoomName'] . '<br>' . $scheduleData[$dayCode][$slot]['TeacherName'] : '');
      echo "<td>$cellContent</td>";
    }
    echo "</tr>";
  }
  echo '</tbody></table></div>';
}