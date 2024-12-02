<div class="container-fluid vh-100 d-flex align-items-center justify-content-center">
  <div class="col-12 col-sm-8 col-md-6 col-lg-4 bg-light rounded shadow p-4">
    <div class="text-center mb-4">
      <!-- <img src="src/logo/logo.png" alt="Logo" class="mb-3" style="width: 80px;"> -->
      <h4>เข้าใช้งานระบบ</h4>
      <p class="text-muted">กรุณากรอก "E-Mail" และ "รหัสผ่าน" เพื่อเข้าสู่ระบบ</p>
      <?php
      if (isset($_GET['error']) && $_GET['error'] == 'invalid_password') {
        echo "<p style='color: red; text-center'>รหัสผ่านไม่ถูกต้อง</p>";
      } else if (isset($_GET['error']) && $_GET['error'] == 'user_not_found') {
        echo "<p style='color: red; '>ไม่มีผู้ใช้งาน</p>";
      }
      ?>
    </div>
    <form action="?page=submit_login" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">E-Mail</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="กรอก E-Mail" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">รหัสผ่าน</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="กรอกรหัสผ่าน" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
    </form>
    <div class="text-center mt-3">
      <!-- <a href="#" class="text-muted">ลืมรหัสผ่านใช่หรือไม่?</a> -->
    </div>
  </div>
</div>