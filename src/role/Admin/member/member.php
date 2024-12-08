<div id="content">
  <?php
  if ($_SESSION['role'] !== 'admin') {
    header("Location: /sds/index.php?page=login");
    exit();
  }
  // ตรวจสอบการเชื่อมต่อฐานข้อมูล
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // กำหนดค่าเริ่มต้นสำหรับการค้นหา
  $searchTerm = '';
  $roleFilter = 'all';

  // ตรวจสอบและรับค่าจากฟอร์มการค้นหา
  if (isset($_POST['search'])) {
    $searchTerm = trim($_POST['search_term']); // ลบช่องว่างด้านหน้าและหลัง
    $searchTerm = htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8'); // ป้องกัน XSS
  }

  // ตรวจสอบและรับค่าจากฟอร์มตัวกรองบทบาท
  if (isset($_POST['role'])) {
    $roleFilter = htmlspecialchars($_POST['role'], ENT_QUOTES, 'UTF-8'); // ป้องกัน XSS
  }

  // สร้างคำสั่ง SQL
  $sql = "SELECT * FROM users WHERE (FullName LIKE ? OR Email LIKE ?)";
  if ($roleFilter !== 'all') {
    $sql .= " AND role = ?";
  }

  // เตรียมคำสั่ง SQL
  $stmt = $conn->prepare($sql);
  if (!$stmt) {
    die("SQL Error: " . $conn->error); // ถ้าเกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL
  }

  // Bind Parameters
  $searchTermWildcard = "%" . $searchTerm . "%"; // เพิ่มเครื่องหมาย % สำหรับ LIKE

  if ($roleFilter !== 'all') {
    // ถ้ามีการกรอกบทบาทเพิ่มเติม
    $stmt->bind_param("sss", $searchTermWildcard, $searchTermWildcard, $roleFilter);
  } else {
    // ถ้าไม่มีการกรอกบทบาท
    $stmt->bind_param("ss", $searchTermWildcard, $searchTermWildcard);
  }

  // Execute และรับผลลัพธ์
  $stmt->execute();
  $result = $stmt->get_result();

  ?>

  <div class="container mt-5">
    <h1 class="mb-4 text-center">จัดการผู้ใช้งาน</h1>

    <!-- ฟอร์มค้นหาข้อมูล -->
    <form class="mb-4" method="POST" action="">
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="search_term" placeholder="ค้นหาชื่อผู้ใช้งาน, อีเมล หรือบทบาท"
          value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button class="btn btn-primary" type="submit" name="search">ค้นหา</button>
      </div>
      <!-- ตัวเลือกบทบาท -->
      <div class="mb-3">
        <label for="role" class="form-label">เลือกบทบาท:</label>
        <select class="form-select" name="role" id="role">
          <option value="all" <?= $roleFilter == 'all' ? 'selected' : '' ?>>ทั้งหมด</option>
          <option value="admin" <?= $roleFilter == 'admin' ? 'selected' : '' ?>>แอดมิน</option>
          <option value="departmenthead" <?= $roleFilter == 'departmenthead' ? 'selected' : '' ?>>หัวหน้าแผนก</option>
          <option value="teacher" <?= $roleFilter == 'teacher' ? 'selected' : '' ?>>ครู</option>
          <option value="academicstaff" <?= $roleFilter == 'academicstaff' ? 'selected' : '' ?>>เจ้าหน้าที่วิชาการ
          </option>
          <option value="executive" <?= $roleFilter == 'executive' ? 'selected' : '' ?>>ผู้บริหาร</option>
        </select>
        <button class="btn btn-info mt-2" type="submit">แสดงผล</button>
      </div>
    </form>

    <!-- ปุ่มเพิ่มสมาชิก -->
    <a href="?page=admin-add-member" class="btn btn-success mb-3">เพิ่มสมาชิกใหม่</a>

    <!-- แสดงตารางข้อมูลผู้ใช้ -->
    <table class="table table-bordered table-striped">
      <thead class="thead-dark text-center">
        <tr>
          <th>รหัสผู้ใช้งาน</th>
          <th>ชื่อผู้ใช้งาน</th>
          <th>อีเมล</th>
          <th>บทบาท</th>
          <th colspan="2">จัดการข้อมูลผู้ใช้งาน</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // ตรวจสอบผลลัพธ์จากการค้นหา
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            // แสดงผลข้อมูลแต่ละแถว
            echo "<tr>";
            echo "<td>" . (isset($row['UserID']) ? htmlspecialchars($row['UserID']) : 'ไม่มีข้อมูล') . "</td>";
            echo "<td class='text-start'>" . (isset($row['FullName']) ? htmlspecialchars($row['FullName']) : 'ไม่มีข้อมูล') . "</td>";
            echo "<td class='text-start'>" . (isset($row['Email']) ? htmlspecialchars($row['Email']) : 'ไม่มีข้อมูล') . "</td>";
            echo "<td class='text-start'>" . (isset($row['Role']) ? htmlspecialchars($row['Role']) : 'ไม่มีข้อมูล') . "</td>";
            // แสดงปุ่มแก้ไขและลบ
            echo "<td class='text-center'><a href='?page=admin-edit-member&id=" . (isset($row['UserID']) ? $row['UserID'] : '') . "' class='btn btn-warning'>แก้ไข</a></td>";
            echo "<td class='text-center'><a href='?page=admin-delete-member&id=" . (isset($row['UserID']) ? $row['UserID'] : '') . "' class='btn btn-danger' onclick='return confirm(\"คุณแน่ใจว่าต้องการลบสมาชิกนี้?\");'>ลบ</a></td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='6' class='text-center'>ไม่มีข้อมูลผู้ใช้</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>