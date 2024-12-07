<?php
include '../../../../Controller/connect.php';

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// แสดงปุ่มย้อนกลับและถัดไป
function renderNavigationButtons()
{
  echo '<div class="d-flex justify-content-center gap-3 mb-3">';
  echo '<button class="btn btn-outline-danger w-50" onclick="showSection(\'summary\', \'src/role/Admin/schedule/summary/summary.php\')">ย้อนกลับ</button>';
  echo '<button class="btn btn-outline-success w-50" onclick="showSection(\'saveschedule\', \'src/role/Admin/schedule/saveschedule/saveschedule.php\')">ถัดไป</button>';
  echo '</div>';
  echo
  '<div class="d-flex justify-content-center gap-3 mb-3">
  <button class="btn btn-success w-50" onclick="showSection(\'createschedule\', \'src/role/Admin/schedule/manageschedule/createschedule.php\')">สร้างแบบจำลองตารางเรียน</button>
  </div>';
}

// ตรวจสอบกลุ่มที่เลือก
function getSelectedGroup($conn)
{
  $currentGroup = isset($_GET['group']) ? $_GET['group'] : 'ปวช.1/1';

  $checkGroupSql = "
    SELECT DISTINCT cg.ClassGroupName 
    FROM schedule sc 
    JOIN classgroup cg ON sc.ClassGroupID = cg.ClassGroupID 
    WHERE cg.ClassGroupName = '" . $conn->real_escape_string($currentGroup) . "';";
  $checkGroupResult = $conn->query($checkGroupSql);

  if ($checkGroupResult->num_rows === 0) {
    echo "<div class='alert alert-warning text-center'>ไม่มีข้อมูลตารางเรียนสำหรับกลุ่ม: " . htmlspecialchars($currentGroup) . "</div>";
    exit;
  }

  return $currentGroup;
}

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

// แปลง TimeSlot
function parseTimeSlot($timeSlot)
{
  $parts = explode('-', $timeSlot);
  $day = substr($parts[0], 0, 3);
  $startSlot = (int)substr($parts[0], 3);
  $endSlot = isset($parts[1]) ? (int)substr($parts[1], 3) : $startSlot;

  return ['day' => $day, 'startSlot' => $startSlot, 'endSlot' => $endSlot];
}

// ดึงข้อมูลตารางเรียน
function getScheduleData($conn, $currentGroup)
{
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
    WHERE cg.ClassGroupName = '" . $conn->real_escape_string($currentGroup) . "';";

  $result = $conn->query($sql);

  $scheduleData = [];
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $parsedSlot = parseTimeSlot($row['TimeSlot']);
      for ($slot = $parsedSlot['startSlot']; $slot <= $parsedSlot['endSlot']; $slot++) {
        $scheduleData[$parsedSlot['day']][$slot] = [
          'SubjectCode' => $row['SubjectCode'],
          'RoomName' => $row['RoomName'],
          'TeacherName' => $row['TeacherName'],
          'ClassGroupName' => $row['ClassGroupName']
        ];
      }
    }
  }

  return $scheduleData;
}

// แสดงตารางเรียน
function renderScheduleTable($scheduleData)
{
  $days = ['mon' => 'วันจันทร์', 'tue' => 'วันอังคาร', 'wed' => 'วันพุธ', 'thu' => 'วันพฤหัสบดี', 'fri' => 'วันศุกร์'];

  echo '<div class="container content">';
  echo '<h2 class="text-center mb-2">ตารางเรียน</h2>';
  echo '<table class="container table table-bordered table-striped table-hover text-center">';
  echo '<thead class="table-info">
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
    <tbody>';

  foreach ($days as $dayCode => $dayName) {
    echo "<tr><td>$dayName</td>";
    for ($slot = 1; $slot <= 12; $slot++) {
      $cellContent = ($dayCode === 'thu' && $slot === 6) ? 'Homeroom' : (
        isset($scheduleData[$dayCode][$slot]) ?
        $scheduleData[$dayCode][$slot]['SubjectCode'] . '<br>' .
        $scheduleData[$dayCode][$slot]['RoomName'] . '<br>' .
        $scheduleData[$dayCode][$slot]['TeacherName'] :
        ''
      );
      echo "<td>$cellContent</td>";
    }
    echo "</tr>";
  }

  echo '</tbody></table></div>';
}

// การทำงานหลัก
renderNavigationButtons();
$currentGroup = getSelectedGroup($conn);
renderMenuLinks($currentGroup);
$scheduleData = getScheduleData($conn, $currentGroup);
renderScheduleTable($scheduleData);