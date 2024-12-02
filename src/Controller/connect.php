<?php
// กำหนดค่าการเชื่อมต่อฐานข้อมูล
// xampp
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_sds";

// host
// $servername = "sds.tkc.ac.th";
// $username = "admin_sds";
// $password = "9dKtIRqzkP";
// $dbname = "admin_sds";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";