<?php
include '../../../../Controller/connect.php';

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL Query เพื่อดึงข้อมูล
$sql = "
SELECT 
    sc.TimeSlot, 
    sc.DayOfWeek, 
    s.SubjectCode, 
    r.RoomName, 
    u.FullName AS TeacherName, 
    cg.ClassGroupName 
FROM schedule sc 
JOIN subjects s ON sc.SubjectID = s.SubjectID 
JOIN rooms r ON sc.RoomID = r.RoomID 
JOIN teachers t ON sc.TeacherID = t.TeacherID 
JOIN users u ON t.UserID = u.UserID 
JOIN classgroup cg ON sc.ClassGroupID = cg.ClassGroupID 
WHERE s.SubjectCode = '20204-2106';
";

$result = $conn->query($sql);

// สร้างอาร์เรย์เพื่อเก็บข้อมูลตารางเรียน
$scheduleData = [];

// เก็บข้อมูลในรูปแบบที่เข้าถึงง่าย
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $scheduleData[$row['DayOfWeek']][$row['TimeSlot']] = [
      'SubjectCode' => $row['SubjectCode'],
      'RoomName' => $row['RoomName'],
      'TeacherName' => $row['TeacherName'],
      'ClassGroupName' => $row['ClassGroupName']
    ];
  }
}

$conn->close();
?>

<div class="container content">
  <h2 class="text-center mb-2">ตารางเรียน</h2>
  <table class="container table table-bordered table-striped table-hover text-center">
    <thead class="table-info">
      <tr>
        <th>เวลา</th>
        <th class="timeslot">07:40<br>08:00</th>
        <th class="timeslot">08:00<br>09:15</th>
        <th class="timeslot">09:15<br>10:15</th>
        <th class="timeslot">10:15<br>11:15</th>
        <th class="timeslot">11:15<br>12:15</th>
        <th class="timeslot">12:15<br>13:00</th>
        <th class="timeslot">13:00<br>14:00</th>
        <th class="timeslot">14:00<br>15:00</th>
        <th class="timeslot">15:00<br>16:00</th>
        <th class="timeslot">16:00<br>17:00</th>
        <th class="timeslot">17:00<br>18:00</th>
        <th class="timeslot">18:00<br>19:00</th>
        <th class="timeslot">19:00<br>20:00</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // สร้างตารางเรียนสำหรับแต่ละวัน
      $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
      foreach ($days as $day) {
        echo "<tr id='row-" . strtolower($day) . "'>";
        echo "<th class='day-name'>วัน" . translateDay($day) . "</th>";
        for ($slot = 1; $slot <= 12; $slot++) {
          $cellContent = '';
          if (isset($scheduleData[$day][$slot])) {
            $cellContent = $scheduleData[$day][$slot]['SubjectCode'] . '<br>' .
              $scheduleData[$day][$slot]['RoomName'] . '<br>' .
              $scheduleData[$day][$slot]['TeacherName'] . '<br>' .
              $scheduleData[$day][$slot]['ClassGroupName'];
          }
          echo "<td id='" . strtolower($day) . $slot . "' class='class-slot'>" . $cellContent . "</td>";
        }
        echo "</tr>";
      }

      // ฟังก์ชันแปลชื่อวัน
      function translateDay($day)
      {
        $days = [
          'Monday' => 'จันทร์',
          'Tuesday' => 'อังคาร',
          'Wednesday' => 'พุธ',
          'Thursday' => 'พฤหัสบดี',
          'Friday' => 'ศุกร์'
        ];
        return $days[$day] ?? $day;
      }
      ?>
    </tbody>
  </table>
</div>