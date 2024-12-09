<?php

$daysOfWeek = ['mon', 'tue', 'wed', 'thu', 'fri'];
$teacherStartID = 1;
$roomStartID = 1;
$timeSlots = range(1, 12);

// แสดงข้อมูลในตัวแปร (เพื่อ Debug)
// echo "<pre>";
// print_r($scheduleRules);
// echo "</pre>";

// ดึงข้อมูล ClassGroup
function callClassGroup($conn)
{
  $classGroups = [];
  $sql = "SELECT * FROM classgroup";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $classGroups[] = $row;
    }
  } else {
    echo "No class groups found.";
    exit;
  }
  return $classGroups;

  // echo "<pre>";
  // print_r($classGroups);
  // echo "</pre>";
}



function callSchedule($conn)
{
  $schedules = []; // กำหนดตัวแปร $schedules เป็น array เปล่าเพื่อป้องกันข้อผิดพลาด
  $sql = "SELECT * FROM schedule";
  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
    // เก็บผลลัพธ์ใน array
    while ($row = $result->fetch_assoc()) {
      $schedules[] = $row;
    }
    echo "<pre>";
    print_r($schedules);
    echo "</pre>";
  } else {
    if (!$result) {
      echo "ข้อผิดพลาดในการดึงข้อมูล: " . $conn->error; // ตรวจสอบข้อผิดพลาดของ SQL Query
    } else {
      // echo "ไม่พบข้อมูลในตาราง schedule<br>"; 

    }
  }

  return $schedules; // คืนค่าผลลัพธ์ (array เปล่าหากไม่มีข้อมูล)
}

function prepare_table($conn, $classGroups, $scheduleRules)
{
  foreach ($classGroups as $classGroup) {
    $tableId = htmlspecialchars($classGroup['ClassGroupName'], ENT_QUOTES, 'UTF-8');

    // กำหนดข้อมูลตารางสำหรับแต่ละ tableId
    if ($tableId === "ปวช.1/1") {
      $scheduleData = [
        'วันจันทร์' => [
          '1-4' => 0,
          '6-9' => 1,
        ],
        'วันอังคาร' => [
          '1-4' => 2,
          '6-8' => 3,
        ],
        'วันพุธ' => [
          '1-3' => 4,
          '6-7' => 5,
          '8-9' => 6,
        ],
        'วันพฤหัสบดี' => [
          '1-3' => 7,
          // '6' => 'HomeRoom',
          '7-8' => 11,
        ],
        'วันศุกร์' => [
          '1-3' => 8,
          '6-7' => 9,
          '8-9' => 10,
        ],
      ];

      $days = [];

      foreach ($scheduleData as $day => $timeSlots) {
        foreach ($timeSlots as $timeRange => $ruleIndex) {
          $days[$day][$timeRange] = $scheduleRules[$ruleIndex]['SubjectCode'] . '<br>' . $scheduleRules[$ruleIndex]['SubjectName'];
        }
      }
    } else if ($tableId === "ปวช.2/1") {
      $scheduleData = [
        'วันจันทร์' => [
          '1-4' => 12,
          '6-9' => 13,
        ],
        'วันอังคาร' => [
          '1-4' => 14,
          '6-9' => 15,
        ],
        'วันพุธ' => [
          '1-3' => 16,
          '6-7' => 17,
          '8-9' => 18,
        ],
        'วันพฤหัสบดี' => [
          '1-2' => 19,
          // '6' => 'HomeRoom',
          '7-8' => 20,
        ],
        'วันศุกร์' => [],
      ];

      $days = [];

      foreach ($scheduleData as $day => $timeSlots) {
        foreach ($timeSlots as $timeRange => $ruleIndex) {
          $days[$day][$timeRange] = $scheduleRules[$ruleIndex]['SubjectCode'] . '<br>' . $scheduleRules[$ruleIndex]['SubjectName'];
        }
      }
    } else if ($tableId === "ปวช.3/1") {
      $scheduleData = [
        'วันจันทร์' => [
          '1-3' => 21,
        ],
        'วันอังคาร' => [],
        'วันพุธ' => [],
        'วันพฤหัสบดี' => [
          // '6' => 'HomeRoom',
          '7-8' => 22,
        ],
        'วันศุกร์' => [],
      ];

      $days = [];

      foreach ($scheduleData as $day => $timeSlots) {
        foreach ($timeSlots as $timeRange => $ruleIndex) {
          $days[$day][$timeRange] = $scheduleRules[$ruleIndex]['SubjectCode'] . '<br>' . $scheduleRules[$ruleIndex]['SubjectName'];
        }
      }
    } else if ($tableId === "ปวช.3/2") {
      $scheduleData = [
        'วันจันทร์' => [
          '1-3' => 23,
        ],
        'วันอังคาร' => [],
        'วันพุธ' => [],
        'วันพฤหัสบดี' => [
          // '6' => 'HomeRoom',
          '7-8' => 24,
        ],
        'วันศุกร์' => [],
      ];

      $days = [];

      foreach ($scheduleData as $day => $timeSlots) {
        foreach ($timeSlots as $timeRange => $ruleIndex) {
          $days[$day][$timeRange] = $scheduleRules[$ruleIndex]['SubjectCode'] . '<br>' . $scheduleRules[$ruleIndex]['SubjectName'];
        }
      }
    } else if ($tableId === "ปวส.1/1") {
      $scheduleData = [
        'วันจันทร์' => [
          '1-4' => 25,
          '6-9' => 26,
          '10-12' => 36,
        ],
        'วันอังคาร' => [
          '1-4' => 27,
          '6-9' => 28,
        ],
        'วันพุธ' => [
          '1-4' => 29,
          '6-9' => 30,
        ],
        'วันพฤหัสบดี' => [
          '1-3' => 31,
          '4-4' => 34,
          '7-8' => 37,
          '9-10' => 34,
        ],
        'วันศุกร์' => [
          '1-3' => 32,
          '4-4' => 35,
          '6-9' => 33,
          '10-12' => 35
        ],
      ];

      $days = [];

      foreach ($scheduleData as $day => $timeSlots) {
        foreach ($timeSlots as $timeRange => $ruleIndex) {
          $days[$day][$timeRange] = $scheduleRules[$ruleIndex]['SubjectCode'] . '<br>' . $scheduleRules[$ruleIndex]['SubjectName'];
        }
      }
    } else if ($tableId === "ปวส.2/1") {
      $scheduleData = [
        'วันจันทร์' => [
          '1-3' => 39,
          '6-8' => 40,
        ],
        'วันอังคาร' => [
          '1-3' => 41,
        ],
        'วันพุธ' => [],
        'วันพฤหัสบดี' => [
          // '6' => 'HomeRoom',
          '7-8' => 38,
        ],
        'วันศุกร์' => [],
      ];

      $days = [];

      foreach ($scheduleData as $day => $timeSlots) {
        foreach ($timeSlots as $timeRange => $ruleIndex) {
          $days[$day][$timeRange] = $scheduleRules[$ruleIndex]['SubjectCode'] . '<br>' . $scheduleRules[$ruleIndex]['SubjectName'];
        }
      }
    } else if ($tableId === "ปวส.2/2") {
      $scheduleData = [
        'วันจันทร์' => [
          '1-3' => 43,
          '6-8' => 44,
        ],
        'วันอังคาร' => [],
        'วันพุธ' => [],
        'วันพฤหัสบดี' => [

          // '6' => 'HomeRoom',
          '7-8' => 42,
        ],
        'วันศุกร์' => [],
      ];

      $days = [];

      foreach ($scheduleData as $day => $timeSlots) {
        foreach ($timeSlots as $timeRange => $ruleIndex) {
          $days[$day][$timeRange] = $scheduleRules[$ruleIndex]['SubjectCode'] . '<br>' . $scheduleRules[$ruleIndex]['SubjectName'];
        }
      }
    } else {
      continue; // ถ้า tableId ไม่ตรงกับกรณีใดเลย
    }

    // แสดงผลตาราง
    echo '
            <h2 class="text-center mb-2">ตารางเรียน ' . $tableId . '</h2>
            <table id="' . $tableId . '" class="container table table-bordered table-striped table-hover text-center">
              <thead class="table-info">
                <tr>
                  <th>เวลา</th>
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
                      <tr>
        <td>วัน/คาบ</td>
      
        <td class="timeslot">1</td>
        <td class="timeslot">2</td>
        <td class="timeslot">3</td>
        <td class="timeslot">4</td>
        <td class="timeslot">5</td>
        <td class="timeslot">6</td>
        <td class="timeslot">7</td>
        <td class="timeslot">8</td>
        <td class="timeslot">9</td>
        <td class="timeslot">10</td>
        <td class="timeslot">11</td>
        <td class="timeslot">12</td>
      </tr>
              </thead>
              <tbody>';

    foreach ($scheduleData as $dayName => $timeSlots) {
      echo '<tr><th class="day-name">' . $dayName . '</th>';

      $occupiedSlots = [];
      for ($slot = 1; $slot <= 12; $slot++) {
        if (in_array($slot, $occupiedSlots)) {
          continue; // ข้ามคาบที่ถูกครอบด้วย colspan แล้ว
        }

        $content = '';
        $colspan = 1;

        if (!empty($timeSlots)) {
          foreach ($timeSlots as $range => $text) {
            list($start, $end) = explode('-', $range);
            if ($slot == $start) {
              $colspan = $end - $start + 1;
              $content = isset($scheduleRules[$text]) ? $scheduleRules[$text]['SubjectCode'] . '<br>' . $scheduleRules[$text]['SubjectName'] : 'N/A';
              $occupiedSlots = range($start, $end);
              break;
            }
          }
        }

        if ($content) {
          echo '<td class="class-slot" colspan="' . $colspan . '">' . $content . '</td>';
        } else {
          echo '<td class="class-slot"></td>'; // ช่องว่างถ้าไม่มีคาบเรียน
        }
      }

      echo '</tr>';
    }


    echo '
              </tbody>
            </table>';
  }
}








$classGroups = callClassGroup($conn);
// showscheduleRules($scheduleRules);
// $schedules  = เก็บข้อมูลตารางเรียน
// $scheduleRules = ข้อมูลที่จะบันทึกลงตารางเรียน
$schedules = callSchedule($conn);
// if (empty($schedules)) {
//   echo "No schedules";
// } else {
//   echo "<pre>";
//   print_r($schedules);
//   echo "</pre>";
// }
prepare_table($conn, $classGroups, $scheduleRules);
