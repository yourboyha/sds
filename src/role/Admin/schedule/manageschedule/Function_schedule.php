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
  if (!empty($scheduleData)) {
    echo "<pre>";
    print_r($scheduleData);
    echo "</pre>";
  } else {
    echo "ไม่มีข้อมูลในตาราง schedule";
  }
}

function isClassGroupNameInSchedule($scheduleData, $ClassGroupName)
{
  $filteredData = array_filter($scheduleData, function ($data) use ($ClassGroupName) {
    return $data['ClassGroupName'] === $ClassGroupName;
  });

  return !empty($filteredData); // ถ้ามีข้อมูล จะคืนค่า true, ถ้าไม่มี จะคืนค่า false
}


// แสดงตารางเรียน
function renderScheduleTable($scheduleData, $ClassGroupName)
{
  require_once __DIR__ . '/table.php';
  // $timeSlots = [
  //   "07:40<br>08:00",
  //   "08:00<br>09:15",
  //   "09:15<br>10:15",
  //   "10:15<br>11:15",
  //   "11:15<br>12:15",
  //   "12:15<br>13:00",
  //   "13:00<br>14:00",
  //   "14:00<br>15:00",
  //   "15:00<br>16:00",
  //   "16:00<br>17:00",
  //   "17:00<br>18:00",
  //   "18:00<br>19:00",
  //   "19:00<br>20:00",
  // ];

  // $days = ['mon' => 'วันจันทร์', 'tue' => 'วันอังคาร', 'wed' => 'วันพุธ', 'thu' => 'วันพฤหัสบดี', 'fri' => 'วันศุกร์'];
  // if (isClassGroupNameInSchedule($scheduleData, $ClassGroupName)) {
  //   echo '<div class="container content">';
  //   echo "<h2 class='text-center mb-2'>ตารางเรียน: $ClassGroupName</h2>";
  //   // echo "<pre>";
  //   // print_r($scheduleData);
  //   // echo "</pre>";
  //   echo '<table class="container table table-bordered table-striped table-hover text-center">';
  //   echo '<thead class="table-info">
  //         <tr>
  //           <th>เวลา</th>';

  //   // ใช้การวนลูปแสดงช่วงเวลา
  //   foreach ($timeSlots as $slot) {
  //     echo "<th class='timeslot'>$slot</th>";
  //   }
  //   echo '</tr>
  //       </thead>
  //       <tbody>';

  //   echo "<tr>";
  //   echo "<td>วัน/คาบ</td>";
  //   echo '<td rowspan="6" class="vertical-text day-name">กิจกรรมหน้าเสาธง</td>';
  //   for ($slot = 1; $slot <= 12; $slot++) {
  //     echo "<td class='timeslot'>คาบที่ $slot</td>";
  //   }
  //   echo "</tr>";

  //   // วนลูปแต่ละวัน
  //   foreach ($days as $dayCode => $dayName) {
  //     echo "<tr>
  //             <td class='day-name'>$dayName</td>";

  //     $skipSlots = 0; // ตัวแปรช่วยข้ามช่องที่อยู่ในช่วงเดียวกัน

  //     // วนลูปแต่ละคาบ
  //     for ($slot = 1; $slot <= 12; $slot++) {
  //       if ($skipSlots > 0) {
  //         $skipSlots--;
  //         continue;
  //       }
  //       $cellContent = '';
  //       $colspan = 1;

  //       // กรองเฉพาะข้อมูลของ ClassGroupName
  //       foreach ($scheduleData as $data) {

  //         if ($data['ClassGroupName'] === $ClassGroupName && $data['DayOfWeek'] === $dayCode) {
  //           // แยก TimeSlot เป็นช่วงเวลา (start-stop)
  //           if (strpos($data['TimeSlot'], '-') !== false) {
  //             [$start, $stop] = explode('-', $data['TimeSlot']);
  //             $start = (int) $start;
  //             $stop = (int) $stop;
  //             $slot = (int) $slot;


  //             if ($slot === $start) {
  //               echo '<br>';
  //               echo 'slot: ' . $slot . '<br>';
  //               echo 'start: ' . $stop;
  //               echo '<br>';

  //               $cellContent = $data['SubjectCode'] . '<br>' .
  //                 $data['RoomName'] . '<br>' .
  //                 $data['TeacherName'];
  //               $colspan = $stop - $start + 1; // คำนวณ colspan
  //               $skipSlots = $colspan - 1; // ข้ามช่องถัดไปตาม colspan
  //               break;
  //             } elseif ((int) $data['TimeSlot'] === $slot) {
  //               // กรณี TimeSlot ไม่ใช่ช่วง
  //               $cellContent = $data['SubjectCode'] . '<br>' .
  //                 $data['RoomName'] . '<br>' .
  //                 $data['TeacherName'];
  //               break;
  //             }
  //           }
  //         }

  //         // กรณีเฉพาะ Homeroom สำหรับวันพฤหัสบดี คาบที่ 6
  //         if ($dayCode === 'thu' && $slot === 6) {
  //           $cellContent = 'Home<br>room';
  //         }
  //         // echo $colspan;
  //         // แสดงข้อมูลในช่อง
  //         if ($colspan > 1) {
  //           echo "<td id='{$dayCode}-slot{$slot}' class='class-slot' colspan='$colspan'>$cellContent</td>";
  //         } else {
  //           echo "<td id='{$dayCode}-slot{$slot}' class='class-slot'>$cellContent</td>";
  //         }
  //       }

  //       echo "</tr>";
  //     }
  //     echo '</tbody></table></div>';
  //     // echo "<pre>";
  //     // print_r($scheduleData);
  //     // echo "</pre>";
  //   }
  // }
}