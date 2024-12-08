<div id="content">
  <?php
  // include 'chkadmin.php';

  // ดึงข้อมูลแพ็คเกจจากฐานข้อมูล
  $searchTerm = $_POST['search_term'] ?? '';


  $sql = "SELECT * FROM studyplans WHERE ClassGroupID LIKE '%$searchTerm%' OR SubjectID  LIKE '%$searchTerm%'";
  $result = $conn->query($sql);
  ?>

  <div class="container mt-5">
    <h1 class="mb-4 text-center">จัดการแผนการเรียน</h1>

    <!-- ฟอร์มค้นหาข้อมูลแพ็คเกจ -->
    <form class="mb-4" method="POST" action="">
      <div class="input-group">
        <input type="text" class="form-control" name="search_term" placeholder="ค้นหาชื่อแผนการเรียน"
          value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button class="btn btn-primary" type="submit" name="search">ค้นหา</button>
      </div>
    </form>

    <!-- ปุ่มเพิ่มแพ็คเกจ -->
    <a href="?page=admin-add-studyplan" class="btn btn-success mb-2">เพิ่มแผนการเรียนใหม่</a>

    <!-- แสดงตารางข้อมูลแพ็คเกจ -->
    <table class="table table-bordered table-striped">
      <thead class="thead-dark text-center">
        <tr>
          <th>รหัสแผนการเรียน</th>
          <th>แผนกวิชา</th>
          <th>กลุ่มเรียน</th>
          <th>ภาคเรียนที่ / ปีการศึกษา</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $StudyPlanID = $row['StudyPlanID'];
            $sqlselectall = "SELECT 
    sp.StudyPlanID, 
    sp.ClassGroupID, 
    d.DepartmentName, 
    cg.ClassGroupName, 
    sp.Term, 
    sp.Year
FROM 
    studyplans sp
JOIN 
    ClassGroup cg ON sp.ClassGroupID = cg.ClassGroupID
JOIN 
    departments d ON cg.DepartmentID = d.DepartmentID;

";
            $result = $conn->query($sqlselectall);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
           
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['ClassGroupID']) . "</td>";
            echo "<td>" . htmlspecialchars($row['DepartmentName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ClssGroupName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Term']) . "/" . ($row['Year']) . "</td>";
            echo "<td class='text-center'><a href='?page=admin-edit-studyplan&id=" . $StudyPlanID . "' class='btn btn-warning'>แก้ไข</a></td>";
            echo "<td class='text-center'><a href='?page=admin-delete-package&id=" . $StudyPlanID . "' class='btn btn-danger' onclick='return confirm(\"คุณแน่ใจว่าต้องการลบแผนการเรียนนี้?\");'>ลบ</a></td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='7' class='text-center'>ไม่มีข้อมูลแผนการเรียน</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>