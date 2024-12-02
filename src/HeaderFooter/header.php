<nav class="navbar navbar-expand-lg" style="background-color: #800000">
  <div class="d-flex align-items-center">
    <!-- Toggle Sidebar Button -->
    <button id="toggleSidebar" class="toggle-btn me-2">
      <i class="bi bi-list"></i>
    </button>
    <!-- Logo -->
    <img src="src/logo/logo.png" alt="Logo" class="logo">
    <!-- <a href="https://sds.tkc.ac.th/" class="navbar-brand text-white  ms-3"> -->
    <a href="index.php?page=home" class="navbar-brand text-white  ms-3">
      <!-- System Name -->
      ระบบสนับสนุนการตัดสินใจในการจัดตารางเรียน
    </a>
  </div>
  <div id="user-section" class="d-flex align-items-center">
    <?php if (isset($_SESSION['username'])): ?>
      <div class="dropdown">
        <a class="nav-link dropdown-toggle border border-white rounded px-3 py-2 text-white" href="#" id="userDropdown"
          role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?= htmlspecialchars($_SESSION['username']); ?>
        </a>

        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
          <?php if ($_SESSION['role'] === 'admin'): ?>
            <li><a href="/careathome/src/view/admin/index.php" class="dropdown-item">แดชบอร์ดแอดมิน</a></li>
            <li><a href="/careathome/src/view/admin/index.php?page=members" class="dropdown-item">จัดการผู้ใช้งาน</a></li>
            <li><a href="/careathome/src/view/admin/index.php?page=package" class="dropdown-item">จัดการแพคเกจ</a></li>
            <li><a href="/careathome/src/view/admin/index.php?page=pr" class="dropdown-item">จัดการข่าวประชาสัมพันธ์</a>
            </li>
            <li><a href="/careathome/src/view/admin/index.php?page=review" class="dropdown-item">จัดการรีวิว</a></li>
            <li><a href="/careathome/src/view/admin/index.php?page=webboard" class="dropdown-item">จัดการเว็บบอร์ด</a>
            </li>
            <li><a href="/careathome/src/view/admin/index.php?page=report" class="dropdown-item">ดูรายงาน</a></li>
          <?php else: ?>
            <li><a href="/careathome/src/view/user/index.php" class="dropdown-item">หน้าหลักผู้ใช้งาน</a></li>
            <li><a href="/careathome/src/view/user/index.php?page=profile" class="dropdown-item">จัดการข้อมูลส่วนตัว</a>
            </li>
            <li><a href="/careathome/src/view/user/index.php?page=patient" class="dropdown-item">จัดการข้อมูลผู้สูงอายุ</a>
            </li>
            <li><a href="/careathome/src/view/user/index.php?page=package" class="dropdown-item">เลือกแพคเกจ</a></li>
            <li><a href="/careathome/src/view/user/index.php?page=webboard" class="dropdown-item">เว็บบอร์ด</a></li>
            <li><a href="/careathome/src/view/user/index.php?page=review" class="dropdown-item">รีวิว</a></li>
          <?php endif; ?>
          <li><a href="/sds/src/Controller/logout.php" class="dropdown-item">ออกจากระบบ</a></li>
        </ul>
      </div>
    <?php else: ?>
      <div class="auth-links">
        <!-- <a href="index.php?page=register" class="btn btn-outline-light">สมัครสมาชิก</a> -->
        <a href="index.php?page=login" class="btn btn-outline-light">เข้าสู่ระบบ</a>
      </div>
    <?php endif; ?>
  </div>
</nav>

</nav>
<div class="d-flex">
  <div class="row h-100">
    <!-- Sidebar -->
    <div id="sidebar" class="col-12 col-md-3 bg-dark p-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link text-white " href="?page=home">หน้าหลัก</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="?page=schedule">ตารางเรียน</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="?page=teaching">ตารางสอน</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="?page=room">ตารางห้อง</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="?page=studyplan">แผนการเรียน</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="?page=course">หลักสูตร</a>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- User Section -->