<?php
require_once 'config.php';
// เริ่มต้น session เพื่อตรวจสอบการเข้าระบบของผู้ใช้งาน
session_start();
// เชื่อมต่อกับฐานข้อมูล
include "src/controller/connect.php";
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ระบบสนับสนุนการตัดสินใจในการจัดตารางเรียน</title>
  <link rel="icon" href="<?php echo BASE_URL; ?>src/logo/logo.png" type="image/ico">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Sarabun:wght@400;600&display=swap"
    rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
</head>

<body>
  <?php
  // เรียกใช้งาน header 
  include "src/HeaderFooter/header.php";
  ?>
  <div class="d-flex flex-column min-vh-100">
    <!-- Content -->
    <main class="flex-fill">
      <?php
      // หน้าในเว็บที่สามารถเลือกได้
      $pages = [
        'home' => BASE_URL . 'src/public/home.php',
        'login' => BASE_URL . 'src/public/loginPage.php',
        'submit_login' => BASE_URL . 'src/controller/submit_login.php',
        'logout' => BASE_URL . 'src/controller/logout.php',
        'schedule' => BASE_URL . 'src/public/schedule.php',
        'teaching' => BASE_URL . 'src/public/teaching.php',
        'room' => BASE_URL . 'src/public/room.php',
        'studyplan' => BASE_URL . 'src/public/studyplan.php',
        'course' => BASE_URL . 'src/public/course.php',
        'table' => BASE_URL . 'src/function/table.php',
        // ส่วนแอดมิน
        'admin' => BASE_URL . 'src/role/Admin/dashboard.php',
        'admin-member' => BASE_URL . 'src/role/Admin/member/member.php',
        'admin-course' => BASE_URL . 'src/role/Admin/course/course.php',
        'admin-subject' => BASE_URL . 'src/role/Admin/subject/subject.php',
        'admin-schedule' => BASE_URL . 'src/role/Admin/schedule/schedule.php',
        'admin-report' => BASE_URL . 'src/role/Admin/report/report.php',
        // ส่วนแผนกวิชา
        'DepartmentHead' => BASE_URL . 'src/role/DepartmentHead/index.php',
        'Executive' => BASE_URL . 'src/role/Executive/index.php',
        'AcademicStaff' => BASE_URL . 'src/role/AcademicStaff/index.php'
      ];

      // ตรวจสอบว่า 'page' ได้รับค่าหรือไม่ และแสดงหน้าที่เลือก
      $page = $_GET['page'] ?? 'home'; // หากไม่มีค่า 'page' ให้ใช้ 'home' เป็นค่าเริ่มต้น

      if (array_key_exists($page, $pages)) {
        $targetPage = str_replace(BASE_URL, '', $pages[$page]); // ลบ BASE_URL ออกจาก path เพื่อการ include
        if (file_exists($targetPage)) {
          include $targetPage; // ใช้ include เมื่อเป็นไฟล์ภายใน
        } else {
          header("Location: " . $pages[$page]); // ใช้ header เมื่อเป็นลิงก์ภายนอก
        }
      } else {
        include "src/public/home.php"; // หากไม่มีหน้าตรงกับที่เลือก ให้แสดงหน้า home
      }
      ?>
    </main>
    <?php
    include "src/HeaderFooter/footer.php";
    ?>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script src="<?php echo BASE_URL; ?>js/script.js"></script>
</body>

</html>