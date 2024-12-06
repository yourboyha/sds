<?php
include '../../../../Controller/connect.php';
// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
<div class="d-flex justify-content-center gap-3 mb-3">
  <button class="btn btn-outline-danger w-50"
    onclick="showSection('manageschedule', 'src/role/Admin/schedule/manageschedule/manageschedule.php')">6.
    >ย้อนกลับ</button>
  <a class="btn btn-outline-success w-50" href="index.php?page=home">6.
    บันทึกและกลับสู่หน้าหลัก</a>
</div>
<div class="d-flex justify-content-center gap-3 mb-3">
  <button class="btn btn-outline-info w-50 ">Export PDF</button>
</div>
<div class="container content">
  <h2 class="text-center mb-2">ตารางเรียน</h2>
  <!-- <div class="table-responsive"> -->
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

      <tr id="row-monday">
        <th class="day-name">วันจันทร์</th>
        <td id="mon-slot1" class="class-slot" colspan="3">21910-2009<br>LAB1<br>ครูคอม1</td>
        <!-- <td id="mon-slot2" class="class-slot"></td>
        <td id="mon-slot3" class="class-slot"></td> -->
        <td id="mon-slot4" class="class-slot">21910-1004<br>LAB3<br>อธิตญาภรณ์</td>
        <td id="mon-slot5" class="class-slot"></td>
        <td id="mon-slot6" class="class-slot" colspan="2">21910-1002<br>LAB3<br>อธิตญาภรณ์</td>
        <!-- <td id="mon-slot7" class="class-slot"></td> -->
        <td id="mon-slot8" class="class-slot" colspan="2">21910-1002<br>LAB3<br>อธิตญาภรณ์</td>
        <!-- <td id="mon-slot9" class="class-slot"></td> -->
        <td id="mon-slot10" class="class-slot"></td>
        <td id="mon-slot11" class="class-slot"></td>
        <td id="mon-slot12" class="class-slot"></td>
      </tr>

      <tr id="row-tuesday">
        <th class="day-name">วันอังคาร</th>
        <td id="tue-slot1" class="class-slot" colspan="4">21910-2010<br>LAB4<br>วุฒิพงศ์</td>
        <!-- <td id="tue-slot2" class="class-slot"></td>
        <td id="tue-slot3" class="class-slot"></td>
        <td id="tue-slot4" class="class-slot"></td> -->
        <td id="tue-slot5" class="class-slot"></td>
        <td id="tue-slot6" class="class-slot" colspan="3">21910-1003<br>LAB4<br>วุฒิพงศ์</td>
        <!-- <td id="tue-slot7" class="class-slot"></td> -->
        <!-- <td id="tue-slot8" class="class-slot"></td> -->
        <td id="tue-slot9" class="class-slot"></td>
        <td id="tue-slot10" class="class-slot"></td>
        <td id="tue-slot11" class="class-slot"></td>
        <td id="tue-slot12" class="class-slot"></td>
      </tr>
      <tr id="row-wednesday">
        <th class="day-name">วันพุธ</th>
        <td id="wed-slot1" class="class-slot" colspan="2">20000-1102<br>ห้องสมุด<br>ไกรศร</td>
        <!-- <td id="wed-slot2" class="class-slot"></td> -->
        <td id="wed-slot3" class="class-slot">20000-1602<br>421A<br>รุ่งสุริยา</td>
        <td id="wed-slot4" class="class-slot"></td>
        <td id="wed-slot5" class="class-slot"></td>
        <td id="wed-slot6" class="class-slot" colspan="2">20000-1203<br>421B<br>ยลธิดา</td>
        <!-- <td id="wed-slot7" class="class-slot"></td> -->
        <td id="wed-slot8" class="class-slot" colspan="2">20000-1603<br>อาคารโดมใหญ่<br>รุ่งสุริยา</td>
        <!-- <td id="wed-slot9" class="class-slot"></td> -->
        <td id="wed-slot10" class="class-slot"></td>
        <td id="wed-slot11" class="class-slot"></td>
        <td id="wed-slot12" class="class-slot"></td>
      </tr>
      <tr id="row-thursday">
        <th class="day-name">วันพฤหัสบดี</th>
        <td id="thu-slot1" class="class-slot" colspan="4">21910-2007<br>LAB2<br>บุญเกียรติ</td>
        <!-- <td id="thu-slot2" class="class-slot"></td>
        <td id="thu-slot3" class="class-slot"></td>
        <td id="thu-slot4" class="class-slot"></td> -->
        <td id="thu-slot5" class="class-slot"></td>
        <td id="thu-slot6" class="class-slot">Home<br>room</td>
        <td id="thu-slot7" class="class-slot" colspan="2">20000-2002<br>อาคารโดมใหญ่<br>บุญเกียรติ</td>
        <!-- <td id="thu-slot8" class="class-slot"></td> -->
        <td id="thu-slot9" class="class-slot"></td>
        <td id="thu-slot10" class="class-slot"></td>
        <td id="thu-slot11" class="class-slot"></td>
        <td id="thu-slot12" class="class-slot"></td>
      </tr>
      <tr id="row-friday">
        <th class="day-name">วันศุกร์</th>
        <td id="fri-slot1" class="class-slot" colspan="3">20001-1003<br>LAB3<br>ปวิตรา</td>
        <!-- <td id="fri-slot2" class="class-slot"></td>
        <td id="fri-slot3" class="class-slot"></td> -->
        <td id="fri-slot4" class="class-slot">21910-1002<br>LAB3<br>อธิตญาภรณ์</td>
        <td id="fri-slot5" class="class-slot"></td>
        <td id="fri-slot6" class="class-slot" colspan="2">20000-1402<br>425<br>ธันยพร</td>
        <!-- <td id="fri-slot7" class="class-slot"></td> -->
        <td id="fri-slot8" class="class-slot"></td>
        <td id="fri-slot9" class="class-slot"></td>
        <td id="fri-slot10" class="class-slot"></td>
        <td id="fri-slot11" class="class-slot"></td>
        <td id="fri-slot12" class="class-slot"></td>
      </tr>
    </tbody>
  </table>



  <!-- รายละเอียดวิชา -->

  <h2 class="text-center mb-2">รายละเอียดวิชา</h2>
  <table class="table table-bordered table-striped table-hover text-center">
    <thead class="table-info">
      <tr>
        <th class="day-name">รหัสวิชา</th>
        <th>ชื่อวิชา</th>
        <th class="day-name">ท.</th>
        <th class="day-name">ป.</th>
        <th class="day-name">ช.</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="day-name">20001-1003</td>
        <td class="text-start ps-3">ธุรกิจเบื้องต้น</td>
        <td>1</td>
        <td>2</td>
        <td>2</td>
      </tr>
      <tr>
        <td class="day-name">21910-1002</td>
        <td class="text-start ps-3">วิเคราะห์ความต้องการทางธุรกิจ</td>
        <td>1</td>
        <td>2</td>
        <td>2</td>
      </tr>
      <tr>
        <td class="day-name">21910-1003</td>
        <td class="text-start ps-3">การเขียนโปรแกรมคอมพิวเตอร์เบื้องต้น</td>
        <td>1</td>
        <td>2</td>
        <td>2</td>
      </tr>
      <tr>
        <td class="day-name">21910-1004</td>
        <td class="text-start ps-3">พาณิชย์อิเล็กทรอนิกส์เบื้องต้น</td>
        <td>1</td>
        <td>2</td>
        <td>2</td>
      </tr>
      <tr>
        <td class="day-name">21910-2007</td>
        <td class="text-start ps-3">โปรแกรมกราฟิกเพื่อสร้างสื่อดิจิทัล</td>
        <td>2</td>
        <td>2</td>
        <td>3</td>
      </tr>
      <tr>
        <td class="day-name">21910-2009</td>
        <td class="text-start ps-3">คณิตศาสตร์คอมพิวเตอร์</td>
        <td>1</td>
        <td>2</td>
        <td>2</td>
      </tr>
      <tr>
        <td class="day-name">21910-2010</td>
        <td class="text-start ps-3">การเขียนโปรแกรมภาษาคอมพิวเตอร์</td>
        <td>2</td>
        <td>2</td>
        <td>3</td>
      </tr>
      <tr>
        <td class="day-name">20000-2002</td>
        <td class="text-start ps-3">กิจกรรมลูกเสือวิสามัญ</td>
        <td>2</td>
        <td>0</td>
        <td>2</td>
      </tr>
    </tbody>
  </table>
</div>
<!-- </div> -->