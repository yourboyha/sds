<?php
if ($_SESSION['role'] !== 'admin') {
  header("Location: /sds/index.php?page=login");
  exit();
}

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // รับข้อมูลจากฟอร์มและป้องกัน XSS
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // แฮชรหัสผ่าน
  $email = htmlspecialchars($_POST['email']);
  $role = htmlspecialchars($_POST['role']);
  $fullname = htmlspecialchars($_POST['fullname']);
  $telephone = htmlspecialchars($_POST['telephone']);

  // สร้างคำสั่ง SQL สำหรับเพิ่มผู้ใช้งาน
  $sql =
    "INSERT INTO users (Password, Email, Role, FullName,  ContactInfo) 
            VALUES (?, ?, ?, ?, ?)";

  // เตรียมคำสั่ง SQL
  if ($stmt = $conn->prepare($sql)) {
    // ผูกค่าพารามิเตอร์
    $stmt->bind_param("sssss", $password, $email, $role, $fullname, $telephone);

    // ตรวจสอบว่าเพิ่มข้อมูลสำเร็จหรือไม่
    if ($stmt->execute()) {

      header("Location:?page=admin-member&success=1");
      exit();
    } else {
      $error_message = "เกิดข้อผิดพลาดในการเพิ่มผู้ใช้งาน: " . $stmt->error;
    }

    // ปิดคำสั่ง SQL
    $stmt->close();
  } else {
    $error_message = "ไม่สามารถเตรียมคำสั่ง SQL ได้";
  }
}
?>
<div id="content">
  <div class="container mt-5 ">
    <h1 class="text-center mb-4">เพิ่มผู้ใช้งาน</h1>

    <!-- แสดงข้อความผิดพลาด -->
    <?php if (isset($error_message)): ?>
      <div class="alert alert-danger">
        <?php echo $error_message; ?>
      </div>
    <?php endif; ?>

    <!-- ฟอร์มเพิ่มผู้ใช้งาน -->
    <form action="" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">ชื่อ - นามสกุล</label>
        <input type="text" class="form-control" id="fullname" name="fullname" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <div class="mb-3">
        <label for="role" class="form-label">สิทธิ์ผู้ใช้งาน</label>
        <select class="form-select" id="role" name="role" required>
          <option value="">เลือกบทบาท</option>
          <option value="admin">แอดมิน</option>
          <option value="DepartmentHead">หัวหน้าแผนก</option>
          <option value="Teacher">ครู</option>
          <option value="AcademicStaff">เจ้าหน้าที่วิชาการ</option>
          <option value="Executive">ผู้บริหาร</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="telephone" class="form-label">หมายเลขโทรศัพท์</label>
        <input type="tel" class="form-control" id="telephone" name="telephone" required>
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-primary">เพิ่มผู้ใช้งาน</button>
        <a href="?page=members" class="btn btn-secondary">กลับ</a>
      </div>
    </form>
  </div>
</div>