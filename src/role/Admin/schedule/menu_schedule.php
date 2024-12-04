<body id="content">

  <div class="container">
    <nav>
      <ul class="nav nav-pills gap-3" id="menu-schedule">
        <li class="nav-item">
          <a class="nav-link text-secondary"
            onclick="showSection('checksubject', 'src/role/Admin/schedule/checksubject/checksubject.php')">1.
            ตรวจสอบรายวิชา</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary"
            onclick="showSection('priority', 'src/role/Admin/schedule/priority/priority.php')">2.
            กำหนดความสำคัญ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary"
            onclick="showSection('constraints', 'src/role/Admin/schedule/constraints/constraints.php')">3.
            กำหนดเงื่อนไข</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary"
            onclick="showSection('manageschedule', 'src/role/Admin/schedule/manageschedule/manageschedule.php')">4.
            จัดการตารางเรียน</a>
        </li>
      </ul>
    </nav>
    <div id="hidecontent">
      <!-- ส่วนเนื้อหา Dynamic -->
      <section id="dynamic-section" class="mt-4"></section>
    </div>

  </div>
  <script>
    // ฟังก์ชันสำหรับแสดงส่วนของเมนูที่เลือก
    function showSection(sectionId, filePath) {
      // กำหนดชื่อ Section ที่จะแสดง
      const dynamicSection = document.getElementById('dynamic-section');

      // ทำการ Fetch เนื้อหาใหม่ผ่าน AJAX
      fetch(filePath)
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
          }
          return response.text();
        })
        .then(html => {
          // ใส่เนื้อหาใหม่ใน Dynamic Section
          dynamicSection.innerHTML = html;

          // เพิ่ม class "active" ให้ Section ปัจจุบัน
          document.querySelectorAll('a.nav-link').forEach(link => link.classList.remove('active'));
          document.querySelector(`a[onclick*="${sectionId}"]`).classList.add('active');
        })
        .catch(error => {
          console.error('Error loading section:', error);
          dynamicSection.innerHTML = "<div class='alert alert-danger'>ไม่สามารถโหลดข้อมูลได้</div>";
        });
    }
  </script>
</body>