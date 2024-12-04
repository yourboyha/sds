<?php
// รหัสผ่านที่ผู้ใช้งานกรอก
$username = "admin";
$input_password = "123456";
include "config.php";
include "src/Controller/connect.php";

// รหัสผ่านที่แฮชแล้วในฐานข้อมูล
// $hashed_password = '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2';

// ค้นหาผู้ใช้ในฐานข้อมูลโดยใช้ Email
$result = $conn->query("SELECT * FROM users WHERE Email='$username'");

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  echo "POST", $input_password;
  echo "<br>";
  echo "ROW", $row['Password'];
  echo "<br>";
  if (password_verify($input_password, $row['Password'])) {
    // เก็บข้อมูลผู้ใช้ใน session
    $_SESSION['user_id'] = $row['UserID'];
    $_SESSION['username'] = $username;
    $_SESSION['role'] = strtolower($row['Role']);
    echo $_SESSION['user_id'];
    echo "<br>";
    echo $_SESSION['username'];
    echo "<br>";
    echo $_SESSION['role'];
    echo "<br>";
  }
}



// ตรวจสอบว่ารหัสผ่านตรงกันหรือไม่
if (password_verify($input_password, $row['Password'])) {
  echo "Password is correct!";
} else {
  echo "Invalid password.";
}
