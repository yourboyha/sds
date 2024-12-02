<nav class="navbar navbar-expand-lg" style="background-color: #800000">
  <div class="d-flex align-items-center">
    <!-- Toggle Sidebar Button -->
    <button id="toggleSidebar" class="toggle-btn me-2">
      <i class="bi bi-list"></i> <!-- Hamburger Icon -->
    </button>
    <!-- Logo -->
    <img src="src/logo/logo.png" alt="Logo" class="logo">
    <a href="/sds" class="navbar-brand text-white  ms-3">
      <!-- System Name -->
      ระบบสนับสนุนการตัดสินใจในการจัดตารางเรียน
    </a>
  </div>

  <!-- User Section -->
  <div id="user-section" class="d-flex align-items-center">
    <?php if (isset($_SESSION['username'])): ?>
      <div class="dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
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