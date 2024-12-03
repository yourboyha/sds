<?php

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // กรองข้อมูลที่รับจากฟอร์ม
  $username = $conn->real_escape_string($_POST['username']);
  $password = $_POST['password'];

  // ค้นหาผู้ใช้ในฐานข้อมูลโดยใช้ Email
  $result = $conn->query("SELECT * FROM users WHERE Email='$username'");

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // ตรวจสอบรหัสผ่านด้วย password_verify
    if (password_verify($password, $row['Password'])) {
      // เก็บข้อมูลผู้ใช้ใน session
      $_SESSION['user_id'] = $row['UserID'];
      $_SESSION['username'] = $username;
      $_SESSION['role'] = strtolower($row['Role']);
      // ตรวจสอบ Role และกำหนดหน้า Redirect
      $redirect = "";
      switch ($_SESSION['role']) {
        case 'admin':
          $redirect = "?page=admin";
          break;
        case 'departmentHead':
          $redirect = "?page=department_head";
          break;
        case 'academicStaff':
          $redirect = "?page=academic_staff";
          break;
        case 'executive':
          $redirect = "?page=executive";
          break;
        default:
          $redirect = "?page=login"; // กรณี Role อื่น ๆ
          break;
      }

      // เปลี่ยนเส้นทางไปยังหน้าที่กำหนด
      header("Location: index.php" . $redirect);
      exit();
    } else {
      // กรณีรหัสผ่านไม่ถูกต้อง
      header("Location: index.php?page=login&error=invalid_password");
      exit();
    }
  } else {
    // กรณีไม่พบผู้ใช้ในฐานข้อมูล
    header("Location: index.php?page=login&error=user_not_found");
    exit();
  }
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
