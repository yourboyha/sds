<div id="content">

  <?php

  // include 'chkadminid.php';
  if ($_SESSION['role'] !== 'admin' || !isset($_GET['id'])) {
    header("Location: /sds/index.php?page=login");
    exit();
  }

  $UserID = $_GET['id'];

  // ดึงข้อมูลผู้ใช้
  $sql = "SELECT * FROM users WHERE UserID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $UserID);
  $stmt->execute();
  $user = $stmt->get_result()->fetch_assoc();
  // echo '<pre>';
  // print_r($user);
  // echo '</pre>';


  // ถ้าฟอร์มถูกส่ง
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = ['email', 'role', 'fullname', 'ContactInfo'];
    $userData = [];
    foreach ($data as $field) $userData[$field] = $_POST[$field];

    // อัพเดตข้อมูลใน users
    $updateSql = "UPDATE users SET email = ?, role = ?, fullname = ?,ContactInfo = ? WHERE UserID = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param(
      "ssssi",
      $userData['email'],
      $userData['role'],
      $userData['fullname'],
      $userData['ContactInfo'],
      $UserID
    );
    $updateSuccess = $stmt->execute();

    $message = ($updateSuccess) ? "ข้อมูลถูกอัพเดตเรียบร้อย" : "เกิดข้อผิดพลาดในการอัพเดตข้อมูล";
    echo "<script>alert('$message'); window.location.href = '?page=admin-member';</script>";
  }
  ?>

  <div class="container mt-3 mb-5">
    <h1 class="text-center">แก้ไขข้อมูลส่วนตัว</h1>

    <form method="POST">
      <div class="mb-3">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['Email']) ?>"
            readonly>
        </div>
        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select class="form-control" name="role" required>
            <option value="">เลือกบทบาท</option>
            <option value="admin">แอดมิน</option>
            <option value="DepartmentHead">หัวหน้าแผนก</option>
            <option value="Teacher">ครู</option>
            <option value="AcademicStaff">เจ้าหน้าที่วิชาการ</option>
            <option value="Executive">ผู้บริหาร</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="fullname" class="form-label">Fullname</label>
          <input type="text" class="form-control" name="fullname" value="<?= htmlspecialchars($user['FullName']) ?>"
            required>
        </div>
        <div class="mb-3">
          <label for="ContactInfo" class="form-label">ContactInfo</label>
          <input type="text" class="form-control" name="ContactInfo"
            value="<?= htmlspecialchars($user['ContactInfo']) ?>" required>
        </div>



        <div class="text-center">
          <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
          <a href="?page=members" class="btn btn-secondary">กลับ</a>
        </div>
    </form>
  </div>
</div>