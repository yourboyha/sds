<?php

// รหัสผ่าน plaintext
$password = "123456";

// สร้างแฮชของรหัสผ่าน
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// แสดงผลลัพธ์ของแฮช
echo $hashed_password;
