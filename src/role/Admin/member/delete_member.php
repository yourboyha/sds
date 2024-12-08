<?php

if ($_SESSION['role'] !== 'admin' || !isset($_GET['id'])) {
    header("Location: /sds/index.php?page=login");
    exit();
}



if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ลบข้อมูลจาก users (ตารางที่มีการเชื่อมโยง)
    $sql = "DELETE FROM users WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // เปลี่ยนเส้นทางกลับไปที่หน้า members พร้อมข้อความสำเร็จ
    header("Location:?page=admin-member&success=1");
    exit();
}
