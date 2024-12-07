<?php

function renderScheduleTable($scheduleData, $ClassGroupName)
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

  foreach ($timeSlots as $slot) {
    echo "<th class='timeslot'>$slot</th>";
  }
  echo '
      </tr>
    </thead>
    <tbody>';

  foreach ($days as $dayCode => $dayName) {
    echo "<tr>
        <td class='day-name'>$dayName</td>";

    $skipSlots = 0; // ตัวแปรช่วยข้ามช่องที่อยู่ในช่วงเดียวกัน

    for ($slot = 1; $slot <= 12; $slot++) {
      if ($skipSlots > 0) {
        $skipSlots--;
        continue;
      }

      $cellContent = '';
      $colspan = 1; // ค่าเริ่มต้นสำหรับ colspan

      // กรองข้อมูลสำหรับ ClassGroupName, DayOfWeek และ TimeSlot
      foreach ($scheduleData as $data) {
        if (
          $data['ClassGroupName'] === $ClassGroupName &&
          $data['DayOfWeek'] === $dayCode
        ) {
          // แยก TimeSlot เป็นช่วงเวลา (start-stop)
          if (strpos($data['TimeSlot'], '-') !== false) {
            [$start, $stop] = explode('-', $data['TimeSlot']);
            $start = (int)$start;
            $stop = (int)$stop;

            if ($slot == $start) {
              $cellContent = $data['SubjectCode'] . '<br>' .
                $data['RoomName'] . '<br>' .
                $data['TeacherName'];
              $colspan = $stop - $start + 1; // คำนวณ colspan
              $skipSlots = $colspan - 1; // ข้ามช่องถัดไปตาม colspan
              break;
            }
          } elseif ((int)$data['TimeSlot'] === $slot) {
            // กรณี TimeSlot ไม่ใช่ช่วง
            $cellContent = $data['SubjectCode'] . '<br>' .
              $data['RoomName'] . '<br>' .
              $data['TeacherName'];
            break;
          }
        }
      }

      if ($dayCode === 'thu' && $slot === 6) {
        $cellContent = 'Home<br>room';
      }

      // แสดงข้อมูลในช่อง
      if ($colspan > 1) {
        echo "<td id='{$dayCode}-slot{$slot}' class='class-slot' colspan='$colspan'>$cellContent</td>";
      } else {
        echo "<td id='{$dayCode}-slot{$slot}' class='class-slot'>$cellContent</td>";
      }
    }

    echo "
      </tr>";
  }

  echo '</tbody>
  </table>
</div>';
}