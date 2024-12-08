<div id="content">
  <?php
  // include 'chkadmin.php';

  // รับค่าค้นหาจากฟอร์ม
  $searchTerm = $_POST['search_term'] ?? '';

  // คำสั่ง SQL ใช้ prepared statement เพื่อความปลอดภัย
  //   $sql = "
  // SELECT DISTINCT
  //     sp.StudyPlanID, 
  //     sp.ClassGroupID, 
  //     d.DepartmentName, 
  //     cg.ClassGroupName, 
  //     sp.Term, 
  //     sp.Year
  // FROM 
  //     studyplans sp
  // JOIN 
  //     ClassGroup cg ON sp.ClassGroupID = cg.ClassGroupID
  // JOIN 
  //     departments d ON cg.DepartmentID = d.DepartmentID
  // WHERE 
  //     sp.ClassGroupID LIKE ? OR sp.SubjectID LIKE ?;
  // ";


  $sql = "
SELECT DISTINCT
    cg.ClassGroupName, 
    d.DepartmentName,
    sp.StudyPlanID,
    sp.Term,
    sp.Year
FROM 
    studyplans sp
JOIN 
    ClassGroup cg ON sp.ClassGroupID = cg.ClassGroupID
JOIN 
    departments d ON cg.DepartmentID = d.DepartmentID
WHERE 
    sp.ClassGroupID LIKE ? OR sp.SubjectID LIKE ?
";

  // ใช้ prepared statement
  $stmt = $conn->prepare($sql);
  $searchWildcard = '%' . $searchTerm . '%';
  $stmt->bind_param("ss", $searchWildcard, $searchWildcard);
  $stmt->execute();
  $result = $stmt->get_result();
  ?>

  <div class="container mt-5">
    <h1 class="mb-4 text-center">จัดการแผนการเรียน</h1>

    <!-- ฟอร์มค้นหาข้อมูล -->
    <form class="mb-4" method="POST" action="">
      <div class="input-group">
        <input type="text" class="form-control" name="search_term" placeholder="ค้นหาชื่อแผนการเรียน"
          value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button class="btn btn-primary" type="submit" name="search">ค้นหา</button>
      </div>
    </form>

    <!-- ปุ่มเพิ่มแผนการเรียน -->
    <a href="?page=admin-add-studyplan" class="btn btn-success mb-2">เพิ่มแผนการเรียนใหม่</a>

    <!-- แสดงตารางข้อมูล -->
    <table class="table table-bordered table-striped">
      <thead class="thead-dark text-center">
        <tr>
          <th>รหัสแผนการเรียน</th>
          <th>แผนกวิชา</th>
          <th>กลุ่มเรียน</th>
          <th>ภาคเรียนที่ / ปีการศึกษา</th>
          <th>จัดการ</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          $displayedGroups = []; // สร้าง array เพื่อเก็บกลุ่มเรียนที่แสดงแล้ว
          while ($row = $result->fetch_assoc()) {
            // ตรวจสอบว่ากลุ่มเรียนถูกแสดงไปแล้วหรือยัง
            if (!in_array($row['ClassGroupName'], $displayedGroups)) {
              // หากยังไม่เคยแสดง ให้เพิ่มลงใน array และแสดงผล
              $displayedGroups[] = $row['ClassGroupName'];

              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['StudyPlanID']) . "</td>";
              echo "<td>" . htmlspecialchars($row['DepartmentName']) . "</td>";
              echo "<td>" . htmlspecialchars($row['ClassGroupName']) . "</td>";
              echo "<td>" . htmlspecialchars($row['Term']) . "/" . htmlspecialchars($row['Year']) . "</td>";
              echo "<td class='text-center'>";
              echo "<a href='?page=admin-edit-studyplan&id=" . htmlspecialchars($row['StudyPlanID']) . "' class='btn btn-warning'>แก้ไข</a> ";
              echo "<a href='?page=admin-delete-package&id=" . htmlspecialchars($row['StudyPlanID']) . "' class='btn btn-danger' onclick='return confirm(\"คุณแน่ใจว่าต้องการลบแผนการเรียนนี้?\");'>ลบ</a>";
              echo "</td>";
              echo "</tr>";
            }
          }
        } else {
          echo "<tr><td colspan='5' class='text-center'>ไม่มีข้อมูลแผนการเรียน</td></tr>";
        }
        ?>

      </tbody>
    </table>
  </div>
</div>