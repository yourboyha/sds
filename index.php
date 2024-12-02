<?php
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
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <?php
  // เรียกใช้งาน header 
  include "src/HeaderFooter/header.php";

  // หน้าในเว็บที่สามารถเลือกได้
  $pages = [
    'about' => 'src/public/about.php',
    'schedule' => 'src/public/schedule.php',
    'contact' => 'src/public/contact.php',
    'login' => 'src/public/loginPage.php',
    'submit_login' => 'src/controller/submit_login.php',
    'register' => 'src/view/register.php',
    'submit_register' => 'src/controller/submit_register.php',
    'logout' => 'src/Controller/logout.php',
    'admin' => '/SDS/src/role/Admin/index.php',
    'Executive' => '/SDS/src/role/Executive/index.php',
    'Academic_Staff' => '/SDS/src/role/Academic_Staff/index.php',
    'Department_Head' => '/SDS/src/role/Department_Head/index.php'
  ];

  // ตรวจสอบว่า 'page' ได้รับค่าหรือไม่ และแสดงหน้าที่เลือก
  $page = $_GET['page'] ?? 'home';  // หากไม่มีค่า 'page' ให้ใช้ 'home' เป็นค่าเริ่มต้น

  if (array_key_exists($page, $pages)) {
    if (strpos($pages[$page], '/') === 0) {
      header("Location: " . $pages[$page]);  // ใช้ header เมื่อเป็นลิงก์ภายนอก
    } else {
      include $pages[$page];  // ใช้ include เมื่อเป็นไฟล์ภายใน
    }
  } else {
    include "src/view/home.php";  // หากไม่มีหน้าตรงกับที่เลือก ให้แสดงหน้า home
  }
  // เรียกใช้งาน footer
  include "HeaderFooter/footer.php";
  ?>

</body>

</html>