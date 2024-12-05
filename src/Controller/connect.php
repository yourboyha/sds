<?php
if ($_SERVER['HTTP_HOST'] == 'localhost') {
  // สำหรับ Localhost
  define('BASE_URL', '/sds/');
  define('DB_HOST', 'localhost'); // เซิร์ฟเวอร์ฐานข้อมูล (ส่วนใหญ่ localhost)
  define('DB_USER', 'root');      // ชื่อผู้ใช้ (ค่าปกติ root)
  define('DB_PASS', '');          // รหัสผ่าน (XAMPP/WAMP ปกติไม่มี)
  define('DB_NAME', 'admin_sds'); // ชื่อฐานข้อมูล
} else {
  // สำหรับ Hosting จริง
  define('BASE_URL', 'https://sds.tkc.ac.th/');
  define('DB_HOST', 'sds.tkc.ac.th'); // เช่น mysql.host.com
  define('DB_USER', 'admin_sds');          // ชื่อผู้ใช้ฐานข้อมูล
  define('DB_PASS', '9dKtIRqzkP');          // รหัสผ่านฐานข้อมูล
  define('DB_NAME', 'admin_sds');     // ชื่อฐานข้อมูล
}

// กำหนดค่าการเชื่อมต่อฐานข้อมูล
$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$dbname = DB_NAME;

// สร้างการเชื่อมต่อ
$conn = new mysqli($host, $user, $pass, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";