<head>


</head>
<?php
if ($_SESSION['role'] !== 'admin') {
  header("Location: " . BASE_URL . "index.php?page=login");
  exit();
}
?>

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
          <a class="nav-link text-secondary disabled"
            onclick="showSection('priority', 'src/role/Admin/schedule/priority/priority.php')">2.
            ความสำคัญ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary disabled"
            onclick="showSection('subjecttype', 'src/role/Admin/schedule/subjecttype/subjecttype.php')">3.
            ประเภทวิชา</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary disabled"
            onclick="showSection('teachingaids', 'src/role/Admin/schedule/teachingaids/teachingaids.php')">4.
            วัสดุ/ครุภัณฑ์</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary disabled"
            onclick="showSection('summary', 'src/role/Admin/schedule/summary/summary.php')">5.
            ตรวจสอบข้อมูล</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-secondary"
            onclick="showSection('manageschedule', 'src/role/Admin/schedule/manageschedule/manageschedule.php')">6.
            แสดงตาราง</a>
        </li>
        <li class="nav-item d-none">
          <a class="nav-link text-secondary"
            onclick="showSection('createsschedule', 'src/role/Admin/schedule/manageschedule/createschedule.php')">6.
            ลองสร้างตารางเรียน</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary disabled"
            onclick="showSection('saveschedule', 'src/role/Admin/schedule/saveschedule/saveschedule.php')">7.
            บันทึกข้อมูล</a>
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
    console.log(sectionId);
    // console.log('Fetching:', filePath);
    // กำหนดชื่อ Section ที่จะแสดง
    const dynamicSection = document.getElementById('dynamic-section');
    console.log(dynamicSection);

    // ทำการ Fetch เนื้อหาใหม่ผ่าน AJAX
    fetch(filePath)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.text();
      })
      .then(html => {
        // console.log(html);
        // ใส่เนื้อหาใหม่ใน Dynamic Section
        dynamicSection.innerHTML = html;

        // เพิ่ม class "active" ให้ Section ปัจจุบัน
        // console.log('Clearing active class from nav-links');
        document.querySelectorAll('a.nav-link').forEach(link => {
          // console.log('Removing active from:', link);
          link.classList.remove('active');
        });

        const activeLink = document.querySelector(`a[onclick*="${sectionId}"]`);
        // console.log('Adding active to:', activeLink);
        activeLink.classList.add('active');
      })
      .catch(error => {
        console.error('Error loading section:', error);
        dynamicSection.innerHTML = "<div class='alert alert-danger'>ไม่สามารถโหลดข้อมูลได้</div>";
      });
  }
  </script>
</body>