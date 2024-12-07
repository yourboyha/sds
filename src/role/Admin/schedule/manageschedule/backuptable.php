<?php
include '../../../../Controller/connect.php';
// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// include '../btnsch.php';
//sql สร้างตารางรายวิชา
$sql = "
SELECT 
sc.TimeSlot, 
sc.DayOfWeek, 
s.SubjectCode, 
r.RoomName, 
u.FullName AS TeacherName, cg.ClassGroupName 
FROM schedule sc JOIN subjects s ON sc.SubjectID = s.SubjectID JOIN rooms r ON sc.RoomID = r.RoomID JOIN teachers t ON sc.TeacherID = t.TeacherID JOIN users u ON t.UserID = u.UserID JOIN classgroup cg ON sc.ClassGroupID = cg.ClassGroupID WHERE s.SubjectCode = '20204-2106';
";

$result = $conn->query($sql);

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

echo '<h2 class="text-center mb-2 test111">ทดสอบสร้างตารางเรียน</h2>';
if ($result->num_rows > 0) {
  $currentGroup = ""; // เก็บชื่อกลุ่มปัจจุบัน
  $i = 1;
  echo "<span class='text-dark fw-bold'>เลือกระดับชั้น :</span>";
  // สร้างเมนูลิงก์นำทางเพียงครั้งเดียว
  $menuLinks = "<ul class='nav nav-pills mb-3'>";
  $groupNames = ['ปวช.1/1', 'ปวช.2/1', 'ปวช.3/1', 'ปวช.3/2', 'ปวส.1/1', 'ปวส.2/1', 'ปวส.2/2'];
  foreach ($groupNames as $groupName) {
    $menuLinks .= "<li class='nav-item'>
    <a class='nav-link btn btn-light text-dark' href='#" . urlencode($groupName) . "'>" . $groupName . "</a>
  </li>";
  }
  $menuLinks .= "</ul>";
  // แสดงเมนูนำทาง
  echo $menuLinks;
}
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





  <!-- รายละเอียดวิชา -->

  <h2 class="text-center mb-2">รายละเอียดวิชา</h2>
  <table class="table table-bordered table-striped table-hover text-center createtable">
    <thead class="table-info">

      <tr>
        <th style="width: 6%;">ลำดับ</th>
        <th style="width: 10%;">รหัสวิชา</th>
        <th style="width: 20%;">ชื่อวิชา</th>
        <th style="width: 4%;">ท</th>
        <th style="width: 4%;">ป</th>
        <th style="width: 4%;">น</th>
        <th style="width: 6%;">แยกคาบ</th>
        <th style="width: 6%;">ความสำคัญ</th>
        <th style="width: 12%;">ทฤษฎี / ปฎิบัติ</th>
        <th style="width: 12%;">ประเภทวิชา</th>
        <th style="width: 16%;">วัสดุ/ครุภัณฑ์</th>
        <th style="width: 16%;">ผลลัพธ์</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td class="day-name">20001-1003</td>
        <td class="text-start ps-3">ธุรกิจเบื้องต้น</td>
        <td>1</td>
        <td>2</td>
        <td>2</td>
        <td>
          <input type="checkbox" id="myCheckbox" onclick="toggleCheckbox()" checked disabled>
        </td>
        <td>5</td>
        <td>ปฎิบัติ</td>
        <td>
          <select id="subjecttype" name="subjecttype" class="form-select" disabled>
            <option value="1">วิชาชีพ</option>
            <option value="2">วิชาชีพ/เรียนร่วม</option>
            <option value="3">วิชาชีพฝึกงาน</option>
            <option value="4">วิชาสามัญ/เรียนร่วม</option>
            <option value="5">กิจกรรม/เรียนร่วม</option>
          </select>
        </td>
        <td>
          <select id="courseDropdown" name="courseCategory" class="form-select" disabled>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
        </td>
        <td><i class="bi bi-check-circle-fill green-check" style=" color: green;"></i></td>
      </tr>
    </tbody>
  </table>
</div>
<!-- </div> -->