<div id="content" class="container">
  <!-- <div class="d-flex justify-content-center mb-3">
    <button class="btn btn-dark fullscreen-btn" onclick="toggleFullscreen()">แสดงผลเต็มจอแนวนอน</button>
  </div> -->
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

      <tr id="row-monday">
        <th class="day-name">วันจันทร์</th>
        <td id="mon-slot1" class="class-slot"></td>
        <td id="mon-slot2" class="class-slot"></td>
        <td id="mon-slot3" class="class-slot"></td>
        <td id="mon-slot4" class="class-slot"></td>
        <td id="mon-slot5" class="class-slot"></td>
        <td id="mon-slot6" class="class-slot"></td>
        <td id="mon-slot7" class="class-slot"></td>
        <td id="mon-slot8" class="class-slot"></td>
        <td id="mon-slot9" class="class-slot"></td>
        <td id="mon-slot10" class="class-slot"></td>
        <td id="mon-slot11" class="class-slot"></td>
        <td id="mon-slot12" class="class-slot"></td>
      </tr>

      <tr id="row-tuesday">
        <th class="day-name">วันอังคาร</th>
        <td id="tue-slot1" class="class-slot"></td>
        <td id="tue-slot2" class="class-slot"></td>
        <td id="tue-slot3" class="class-slot"></td>
        <td id="tue-slot4" class="class-slot"></td>
        <td id="tue-slot5" class="class-slot"></td>
        <td id="tue-slot6" class="class-slot"></td>
        <td id="tue-slot7" class="class-slot"></td>
        <td id="tue-slot8" class="class-slot"></td>
        <td id="tue-slot9" class="class-slot"></td>
        <td id="tue-slot10" class="class-slot"></td>
        <td id="tue-slot11" class="class-slot"></td>
        <td id="tue-slot12" class="class-slot"></td>
      </tr>
      <tr id="row-wednesday">
        <th class="day-name">วันพุธ</th>
        <td id="wed-slot1" class="class-slot"></td>
        <td id="wed-slot2" class="class-slot"></td>
        <td id="wed-slot3" class="class-slot"></td>
        <td id="wed-slot4" class="class-slot"></td>
        <td id="wed-slot5" class="class-slot"></td>
        <td id="wed-slot6" class="class-slot"></td>
        <td id="wed-slot7" class="class-slot"></td>
        <td id="wed-slot8" class="class-slot"></td>
        <td id="wed-slot9" class="class-slot"></td>
        <td id="wed-slot10" class="class-slot"></td>
        <td id="wed-slot11" class="class-slot"></td>
        <td id="wed-slot12" class="class-slot"></td>
      </tr>
      <tr id="row-thursday">
        <th class="day-name">วันพฤหัสบดี</th>
        <td id="thu-slot1" class="class-slot"></td>
        <td id="thu-slot2" class="class-slot"></td>
        <td id="thu-slot3" class="class-slot"></td>
        <td id="thu-slot4" class="class-slot"></td>
        <td id="thu-slot5" class="class-slot"></td>
        <td id="thu-slot6" class="class-slot">Home<br>room</td>
        <td id="thu-slot7" class="class-slot"></td>
        <td id="thu-slot8" class="class-slot"></td>
        <td id="thu-slot9" class="class-slot"></td>
        <td id="thu-slot10" class="class-slot"></td>
        <td id="thu-slot11" class="class-slot"></td>
        <td id="thu-slot12" class="class-slot"></td>
      </tr>
      <tr id="row-friday">
        <th class="day-name">วันศุกร์</th>
        <td id="fri-slot1" class="class-slot"></td>
        <td id="fri-slot2" class="class-slot"></td>
        <td id="fri-slot3" class="class-slot"></td>
        <td id="fri-slot4" class="class-slot"></td>
        <td id="fri-slot5" class="class-slot"></td>
        <td id="fri-slot6" class="class-slot"></td>
        <td id="fri-slot7" class="class-slot"></td>
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