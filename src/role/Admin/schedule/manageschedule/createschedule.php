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

$result = $conn->query($sql);

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
  <!-- <div class="table-responsive"> -->
  <table class="container table table-bordered table-striped table-hover text-center ">
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

      <tr id="row-monday">
        <th class="day-name">วันจันทร์</th>
        <td id="mon1" class="class-slot"><br><br></td>
        <td id="mon2" class="class-slot"><br><br></td>
        <td id="mon3" class="class-slot"><br><br></td>
        <td id="mon4" class="class-slot"><br><br></td>
        <td id="mon5" class="class-slot"><br><br></td>
        <td id="mon6" class="class-slot"><br><br></td>
        <td id="mon7" class="class-slot"><br><br></td>
        <td id="mon8" class="class-slot"><br><br></td>
        <td id="mon9" class="class-slot"><br><br></td>
        <td id="mon10" class="class-slot"><br><br></td>
        <td id="mon11" class="class-slot"><br><br></td>
        <td id="mon12" class="class-slot"><br><br></td>
      </tr>

      <tr id="row-tuesday">
        <th class="day-name">วันอังคาร</th>
        <td id="tue1" class="class-slot"><br><br></td>
        <td id="tue2" class="class-slot"><br><br></td>
        <td id="tue3" class="class-slot"><br><br></td>
        <td id="tue4" class="class-slot"><br><br></td>
        <td id="tue5" class="class-slot"><br><br></td>
        <td id="tue6" class="class-slot"><br><br></td>
        <td id="tue7" class="class-slot"><br><br></td>
        <td id="tue8" class="class-slot"><br><br></td>
        <td id="tue9" class="class-slot"><br><br></td>
        <td id="tue10" class="class-slot"><br><br></td>
        <td id="tue11" class="class-slot"><br><br></td>
        <td id="tue12" class="class-slot"><br><br></td>
      </tr>
      <tr id="row-wednesday">
        <th class="day-name">วันพุธ</th>
        <td id="wed1" class="class-slot"><br><br></td>
        <td id="wed2" class="class-slot"><br><br></td>
        <td id="wed3" class="class-slot"><br><br></td>
        <td id="wed4" class="class-slot"><br><br></td>
        <td id="wed5" class="class-slot"><br><br></td>
        <td id="wed6" class="class-slot"><br><br></td>
        <td id="wed7" class="class-slot"><br><br></td>
        <td id="wed8" class="class-slot"><br><br></td>
        <td id="wed9" class="class-slot"><br><br></td>
        <td id="wed10" class="class-slot"><br><br></td>
        <td id="wed11" class="class-slot"><br><br></td>
        <td id="wed12" class="class-slot"><br><br></td>
      </tr>
      <tr id="row-thursday">
        <th class="day-name">วันพฤหัสบดี</th>
        <td id="thu1" class="class-slot"><br><br></td>
        <td id="thu2" class="class-slot"><br><br></td>
        <td id="thu3" class="class-slot"><br><br></td>
        <td id="thu4" class="class-slot"><br><br></td>
        <td id="thu5" class="class-slot"><br><br></td>
        <td id="thu6" class="class-slot">Home<br>room</td>
        <td id="thu7" class="class-slot"><br><br></td>
        <td id="thu8" class="class-slot"><br><br></td>
        <td id="thu9" class="class-slot"><br><br></td>
        <td id="thu10" class="class-slot"><br><br></td>
        <td id="thu11" class="class-slot"><br><br></td>
        <td id="thu12" class="class-slot"><br><br></td>
      </tr>
      <tr id="row-friday">
        <th class="day-name">วันศุกร์</th>
        <td id="fri1" class="class-slot"><br><br></td>
        <td id="fri2" class="class-slot"><br><br></td>
        <td id="fri3" class="class-slot"><br><br></td>
        <td id="fri4" class="class-slot"><br><br></td>
        <td id="fri5" class="class-slot"><br><br></td>
        <td id="fri6" class="class-slot"><br><br></td>
        <td id="fri7" class="class-slot"><br><br></td>
        <td id="fri8" class="class-slot"><br><br></td>
        <td id="fri9" class="class-slot"><br><br></td>
        <td id="fri10" class="class-slot"><br><br></td>
        <td id="fri11" class="class-slot"><br><br></td>
        <td id="fri12" class="class-slot"><br><br></td>
      </tr>
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