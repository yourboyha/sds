<h3>กำหนดข้อจำกัด</h3>
<form id="constraints-form">
  <label for="time-limit">ช่วงเวลาที่อนุญาต:</label>
  <input type="text" id="time-limit" placeholder="8:00 - 16:00">
  <br>
  <label for="room-type">ประเภทห้องเรียน:</label>
  <select id="room-type">
    <option value="standard">ห้องเรียนปกติ</option>
    <option value="lab">ห้องปฏิบัติการ</option>
  </select>
  <br>
  <label for="max-hours">จำนวนชั่วโมงสูงสุดต่อวัน:</label>
  <input type="number" id="max-hours" placeholder="8">
  <br>
  <button type="submit">บันทึกข้อจำกัด</button>
</form>