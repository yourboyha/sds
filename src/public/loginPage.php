<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="container-fluid vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100">

      <!-- Right Section -->
      <div class="col-md-6 bg-light d-flex justify-content-center align-items-center">
        <div class="p-5 border rounded shadow">
          <div class="text-center mb-4">
            <img src="../logo/ตราวิทยาลัยpng.png" alt="Logo" class="mb-3" style="width: 80px;">
            <h3>ระบบบริหารสถานศึกษา</h3>
          </div>
          <form>
            <div class="mb-3">
              <label for="username" class="form-label">ชื่อผู้ใช้งาน</label>
              <input type="text" class="form-control" id="username" placeholder="กรอกชื่อผู้ใช้งาน" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">รหัสผ่าน</label>
              <input type="password" class="form-control" id="password" placeholder="กรอกรหัสผ่าน" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
          </form>
          <div class="text-center mt-3">
            <a href="#" class="text-muted">ลืมรหัสผ่านใช่หรือไม่?</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  // เรียกใช้งาน footer
  include "src/HeaderFooter/footer.html";
  ?>
</body>

</html>