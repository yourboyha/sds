<?php

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
echo "Connected successfully";
