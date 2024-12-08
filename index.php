<?php

// เริ่มต้น session เพื่อตรวจสอบการเข้าระบบของผู้ใช้งาน
session_start();
// require_once 'config.php';
// เชื่อมต่อกับฐานข้อมูล
require_once "src/controller/connect.php";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/schedulestyles.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/priority.css">
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
        'home' => 'src/public/home.php',
        'login' => 'src/public/loginPage.php',
        'submit_login' => 'src/Controller/submit_login.php',
        'logout' => 'src/Controller/logout.php',
        'schedule' => 'src/public/schedule.php',
        'teaching' => 'src/public/teaching.php',
        'room' => 'src/public/room.php',
        'studyplan' => 'src/public/studyplan.php',
        'course' => 'src/public/course.php',
        'table' => 'src/function/table.php',
        // ส่วนแอดมิน
        'admin' => 'src/role/Admin/dashboard.php',
        // member
        'admin-member' => 'src/role/Admin/member/member.php',
        'admin-add-member' => 'src/role/Admin/member/add_member.php',
        'admin-edit-member' => 'src/role/Admin/member/edit_member.php',
        'admin-delete-member' => 'src/role/Admin/member/delete_member.php',
        // course
        'admin-studyplan' => 'src/role/Admin/studyplan/studyplan.php',
        'admin-add-studyplan' => 'src/role/Admin/studyplan/add_studyplan.php',
        'admin-edit-studyplan' => 'src/role/Admin/studyplan/edit_studyplan.php',
        'admin-delete-studyplan' => 'src/role/Admin/studyplan/delete_studyplan.php',
        // subject
        'admin-subject' => 'src/role/Admin/subject/subject.php',
        // schedule
        'admin-menu-schedule' => 'src/role/Admin/schedule/menu_schedule.php',
        // room
        'admin-room' => 'src/role/Admin/subject/subject.php',
        // report
        'admin-report' => 'src/role/Admin/report/report.php',
        // ส่วนแผนกวิชา
        'DepartmentHead' => 'src/role/DepartmentHead/index.php',
        'Executive' => 'src/role/Executive/index.php',
        'AcademicStaff' => 'src/role/AcademicStaff/index.php'
      ];

      // ตรวจสอบว่า 'page' ได้รับค่าหรือไม่ และแสดงหน้าที่เลือก
      $page = $_GET['page'] ?? 'home'; // หากไม่มีค่า 'page' ให้ใช้ 'home' เป็นค่าเริ่มต้น

      if (array_key_exists($page, $pages)) {
        $targetPage = $pages[$page]; // Path ของไฟล์เป้าหมายในระบบไฟล์
        if (file_exists($targetPage)) {
          include $targetPage; // ใช้ include สำหรับไฟล์ภายใน
        } else {
          echo "else ใน";
          header("Location: " . BASE_URL . "index.php?page=home");
          exit;
        }
      } else {
        // echo "else นอก";
        include "src/public/home.php";
        // include "src/Controller/submit_login.php";
      }
      ?>
    </main>

    <?php
    include "src/HeaderFooter/footer.php";
    ?>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script> <!-- Custom JS -->
  <script src="<?php echo BASE_URL; ?>js/script.js"></script>
</body>

</html>