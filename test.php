<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>จัดการตารางเรียน</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    section {
      display: none;
      /* ซ่อนทุกส่วนเริ่มต้น */
    }

    section.active {
      display: block;
      /* แสดงเฉพาะส่วนที่เลือก */
    }
  </style>
</head>

<body>

  <div id="content">
    <div class="container mt-4">
      <nav>
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link text-secondary" href="#manage-schedule"
              onclick="showSection('manage-schedule')">จัดการตารางเรียน</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" href="#constraints"
              onclick="showSection('constraints')">กำหนดข้อจำกัด</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" href="#priority"
              onclick="showSection('priority')">กำหนดเงื่อนไขการจัดลำดับความสำคัญ</a>
          </li>
        </ul>
      </nav>

      <!-- ส่วนจัดการตารางเรียน -->
      <section id="manage-schedule" class="active">
        <h3>จัดการตารางเรียน</h3>
        <button onclick="addSchedule()">เพิ่มตารางเรียน</button>
        <button onclick="editSchedule()">แก้ไขตารางเรียน</button>
        <button onclick="deleteSchedule()">ลบตารางเรียน</button>
      </section>

      <!-- ส่วนกำหนดข้อจำกัด -->
      <section id="constraints">
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
      </section>

      <!-- ส่วนกำหนดเงื่อนไขการจัดลำดับความสำคัญ -->
      <section id="priority">
        <h3>กำหนดเงื่อนไขการจัดลำดับความสำคัญ</h3>
        <form id="priority-form">
          <label for="priority-subject">จัดลำดับความสำคัญวิชา:</label>
          <select id="priority-subject" multiple>
            <option value="math">คณิตศาสตร์</option>
            <option value="science">วิทยาศาสตร์</option>
            <option value="thai">ภาษาไทย</option>
            <option value="english">ภาษาอังกฤษ</option>
          </select>
          <br>
          <label for="priority-teacher">จัดลำดับความสำคัญครู:</label>
          <input type="text" id="priority-teacher" placeholder="ชื่อครู">
          <br>
          <button type="submit">บันทึกเงื่อนไข</button>
        </form>
      </section>
    </div>
  </div>

  <script>
    // ฟังก์ชันสำหรับแสดงส่วนของเมนูที่เลือก
    function showSection(sectionId) {
      // ซ่อนทุก Section
      document.querySelectorAll('section').forEach(section => {
        section.classList.remove('active');
      });

      // แสดงเฉพาะ Section ที่เลือก
      document.getElementById(sectionId).classList.add('active');
    }

    // ตัวอย่างฟังก์ชันเพิ่มเติม
    function addSchedule() {
      alert('ฟังก์ชันเพิ่มตารางเรียน');
    }

    function editSchedule() {
      alert('ฟังก์ชันแก้ไขตารางเรียน');
    }

    function deleteSchedule() {
      alert('ฟังก์ชันลบตารางเรียน');
    }
  </script>

  <!-- Include Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>