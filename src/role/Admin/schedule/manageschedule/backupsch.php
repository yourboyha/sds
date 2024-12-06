<?php
include '../../../../Controller/connect.php';
// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo '<div class="d-flex justify-content-center gap-3 mb-3">';
echo '<button class="btn btn-outline-danger w-50" onclick="showSection(\'summary\', \'src/role/Admin/schedule/summary/summary.php\')">ย้อนกลับ</button>';
echo '<button class="btn btn-outline-success w-50" onclick="showSection(\'saveschedule\', \'src/role/Admin/schedule/saveschedule/saveschedule.php\')">ถัดไป</button>';
echo '</div>';

$currentGroup = isset($_GET['group']) ? $_GET['group'] : 'ปวช.1/1';


$checkGroupSql = "
SELECT DISTINCT cg.ClassGroupName 
FROM schedule sc 
JOIN classgroup cg ON sc.ClassGroupID = cg.ClassGroupID 
WHERE cg.ClassGroupName = '" . $conn->real_escape_string($currentGroup) . "';
";

$checkGroupResult = $conn->query($checkGroupSql);

if ($checkGroupResult->num_rows === 0) {
  echo "<div class='alert alert-warning text-center'>ไม่มีข้อมูลตารางเรียนสำหรับกลุ่ม: " . htmlspecialchars($currentGroup) . "</div>";
  exit;
}
include 'menulink.php';


$groupNames = ['ปวช.1/1', 'ปวช.2/1', 'ปวช.3/1', 'ปวช.3/2', 'ปวส.1/1', 'ปวส.2/1', 'ปวส.2/2'];
echo "<ul class='nav nav-pills mb-3'>";
foreach ($groupNames as $groupName) {
  $activeClass = ($currentGroup === $groupName) ? 'active' : '';
  echo "<li class='nav-item'>
        <a class='nav-link btn btn-light text-dark $activeClass' href='?group=" . urlencode($groupName) . "'>$groupName</a>
    </li>";
}
echo "</ul>";

//sql สร้างตารางรายวิชา
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
WHERE cg.ClassGroupName = '" . $conn->real_escape_string($currentGroup) . "';
";
$result = $conn->query($sql);
include 'menulink.php';
// สร้างอาร์เรย์เพื่อเก็บข้อมูลตารางเรียน
$scheduleData = [];

// ฟังก์ชันแปลง TimeSlot
function parseTimeSlot($timeSlot)
{
  // แยกช่วง เช่น mon1-mon4
  $parts = explode('-', $timeSlot);
  $day = substr($parts[0], 0, 3); // เช่น "mon"
  $startSlot = (int)substr($parts[0], 3); // เช่น "1"
  $endSlot = isset($parts[1]) ? (int)substr($parts[1], 3) : $startSlot; // เช่น "4"
  return ['day' => $day, 'startSlot' => $startSlot, 'endSlot' => $endSlot];
}

// เก็บข้อมูลในรูปแบบที่เข้าถึงง่าย
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // แปลง TimeSlot
    $parsedSlot = parseTimeSlot($row['TimeSlot']);
    $day = $parsedSlot['day'];
    $startSlot = $parsedSlot['startSlot'];
    $endSlot = $parsedSlot['endSlot'];
    // เก็บข้อมูลในช่วงเวลา
    for ($slot = $startSlot; $slot <= $endSlot; $slot++) {
      $scheduleData[$day][$slot] = [
        'SubjectCode' => $row['SubjectCode'],
        'RoomName' => $row['RoomName'],
        'TeacherName' => $row['TeacherName'],
        'ClassGroupName' => $row['ClassGroupName']
      ];
    }
  }
}



// print_r($scheduleData);
echo '<div class="d-flex justify-content-center gap-3 mb-3">';
echo '<button class="btn btn-success w-100 ">สร้างตารางเรียน</button>';
echo '</div>';
if ($result->num_rows > 0) {

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
      <tr>
        <td>วัน/คาบ</td>
        <td rowspan="6" class="vertical-text day-name">กิจกรรมหน้าเสาธง</td>
        <?php for ($i = 1; $i <= 12; $i++) : ?>
        <td class="timeslot"><?php echo $i; ?></td>
        <?php endfor; ?>
      </tr>
      <?php
        // แปลงชื่อวัน
        $days = ['mon' => 'วันจันทร์', 'tue' => 'วันอังคาร', 'wed' => 'วันพุธ', 'thu' => 'วันพฤหัสบดี', 'fri' => 'วันศุกร์'];
        foreach ($days as $dayCode => $dayName) {
          echo "<tr>";
          echo "<td>$dayName</td>";
          for ($slot = 1; $slot <= 12; $slot++) {
            // เพิ่ม Homeroom ในวันพฤหัส คาบที่ 6
            if ($dayCode === 'thu' && $slot === 6) {
              $cellContent = 'Homeroom';
            } else {
              $cellContent = isset($scheduleData[$dayCode][$slot])
                ? $scheduleData[$dayCode][$slot]['SubjectCode'] . '<br>' .
                $scheduleData[$dayCode][$slot]['RoomName'] . '<br>' .
                $scheduleData[$dayCode][$slot]['TeacherName'] . '<br>'
                // $scheduleData[$dayCode][$slot]['ClassGroupName']
                : '';
            }
            echo "<td class='class-slot'>$cellContent</td>";
          }
          echo "</tr>";
        }

        ?>
    </tbody>
  </table>
  <?php
  //sql สร้างตารางรายวิชา
  $sql = "
SELECT
cg.ClassGroupName,
s.SubjectCode,
s.SubjectName,
s.TheoryHours,
s.PracticalHours,
s.CreditHours,
sp.Term
FROM
StudyPlans sp
JOIN
ClassGroup cg ON sp.ClassGroupID = cg.ClassGroupID
JOIN
Subjects s ON sp.SubjectID = s.SubjectID
WHERE
cg.ClassGroupName IN ('ปวช.1/1', 'ปวช.2/1', 'ปวช.3/1', 'ปวช.3/2', 'ปวส.1/1', 'ปวส.2/1', 'ปวส.2/2')
ORDER BY
cg.ClassGroupName, sp.Term, s.SubjectCode;
";

  // รันคำสั่ง SQL และเก็บผลลัพธ์
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // วนลูปข้อมูลเพื่อสร้างเนื้อหา
    while ($row = $result->fetch_assoc()) {
      // เริ่มต้นตารางใหม่หาก ClassGroupName เปลี่ยน
      if ($currentGroup !== $row['ClassGroupName']) {
        // ปิดตารางก่อนหน้า
        if ($currentGroup !== "") {
          echo "</table>";
          $i = 1;
        }
        // แสดงชื่อกลุ่มใหม่
        $currentGroup = $row['ClassGroupName'];
        echo "<h3 id='" . urlencode($currentGroup) . "' class='text-center mb-2'>" . $currentGroup . "</h3>";
        echo "<table class='table table-striped table-hover table-bordered'>
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>รหัสวิชา</th>
      <th>ชื่อวิชา</th>
      <th>ท</th>
      <th>ป</th>
      <th>น</th>
      <th>ผลลัพธ์</th>
          </tr>
  </thead>
  <tbody>";
      }
      // แสดงข้อมูลในแถวของตาราง
      echo "<tr>
      <td class='day-name'>" . $i . "</td>
      <td class='day-name text-start'>" . $row['SubjectCode'] . "</td>
      <td class='text-start'>" . $row['SubjectName'] . "</td>
      <td class='day-name'>" . $row['TheoryHours'] . "</td>
      <td class='day-name'>" . $row['PracticalHours'] . "</td>
      <td class='day-name'>" . $row['CreditHours'] . "</td>
      <td><i class='bi bi-check-circle-fill green-check' style=' color: green;'></i></td>
    </tr>";
      $i++;
    }  // ปิดตารางสุดท้าย
    echo "</tbody>
</table>";
  } else {
    echo "<div class='alert alert-warning'>ไม่มีข้อมูล</div>";
  }
}
  ?>