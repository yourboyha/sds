<?php
function showSubject($conn)
{
  //sql สร้างตารางรายวิชา
  $sql = "
SELECT
cg.ClassGroupName,
s.SubjectCode,
s.SubjectName,
s.TheoryHours,
s.PracticalHours,
s.CreditHours,
sp.Term
FROM
StudyPlans sp
JOIN
ClassGroup cg ON sp.ClassGroupID = cg.ClassGroupID
JOIN
Subjects s ON sp.SubjectID = s.SubjectID
WHERE
cg.ClassGroupName IN ('ปวช.1/1', 'ปวช.2/1', 'ปวช.3/1', 'ปวช.3/2', 'ปวส.1/1', 'ปวส.2/1', 'ปวส.2/2')
ORDER BY
cg.ClassGroupName, sp.Term, s.SubjectCode;
";
?>


<?php

  // รันคำสั่ง SQL และเก็บผลลัพธ์
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $currentGroup = ""; // เก็บชื่อกลุ่มปัจจุบัน
    $i = 1;
    echo "<span class='text-dark fw-bold'>เลือกระดับชั้น :</span>";
    // สร้างเมนูลิงก์นำทางเพียงครั้งเดียว
    $menuLinks = "<ul class='nav nav-pills mb-3'>";

    $groupNames = ['ปวช.1/1', 'ปวช.2/1', 'ปวช.3/1', 'ปวช.3/2', 'ปวส.1/1', 'ปวส.2/1', 'ปวส.2/2'];
    foreach ($groupNames as $groupName) {
      // <a class='nav-link btn btn-light text-dark' href='#" . urlencode($groupName) . "'>" . $groupName . "</a>

      $menuLinks .= '<li class="nav-item">';
      switch ($groupName) {
        case 'ปวช.1/1':
          $menuLinks .= '<a class="nav-link btn btn-light text-dark" 
            onclick="showSection(\'table1\', \'src/role/Admin/schedule/manageschedule/table/table1.php\')">';
          break;
        case 'ปวช.2/1':
          $menuLinks .= '<a class="nav-link btn btn-light text-dark" 
            onclick="showSection(\'table2\', \'src/role/Admin/schedule/manageschedule/table/table2.php\')">';
          break;
        case 'ปวช.3/1':
          $menuLinks .= '<a class="nav-link btn btn-light text-dark" 
            onclick="showSection(\'table3\', \'src/role/Admin/schedule/manageschedule/table/table3.php\')">';
          break;
        case 'ปวช.3/2':
          $menuLinks .= '<a class="nav-link btn btn-light text-dark" 
            onclick="showSection(\'table4\', \'src/role/Admin/schedule/manageschedule/table/table4.php\')">';
          break;
        case 'ปวส.1/1':
          $menuLinks .= '<a class="nav-link btn btn-light text-dark" 
            onclick="showSection(\'table5\', \'src/role/Admin/schedule/manageschedule/table/table5.php\')">';
          break;
        case 'ปวส.2/1':
          $menuLinks .= '<a class="nav-link btn btn-light text-dark" 
            onclick="showSection(\'table6\', \'src/role/Admin/schedule/manageschedule/table/table6.php\')">';
          break;
        case 'ปวส.2/2':
          $menuLinks .= '<a class="nav-link btn btn-light text-dark" 
            onclick="showSection(\'table7\', \'src/role/Admin/schedule/manageschedule/table/table7.php\')">';
          break;
        default:
          $menuLinks .= '<a class="nav-link btn btn-light text-dark" 
            onclick="showSection(\'default\', \'src/role/Admin/schedule/manageschedule/table/default.php\')">';
          break;
      }

      $menuLinks .= htmlspecialchars($groupName) . '</a></li>';
    }
    $menuLinks .= "</ul>";

    // แสดงเมนูนำทาง
    echo $menuLinks;
    $i = 1;

    // วนลูปข้อมูลเพื่อสร้างเนื้อหา
    while ($row = $result->fetch_assoc()) {
      $tableId = 'group' . $i; // ตั้ง id เป็น group1, group2, ...
      echo '<div id="$tableId">';
      // เริ่มต้นตารางใหม่หาก ClassGroupName เปลี่ยน
      if ($currentGroup !== $row['ClassGroupName']) {
        // ปิดตารางก่อนหน้า
        if ($currentGroup !== "") {
          echo "</table>";
        }
        // แสดงชื่อกลุ่มใหม่
        $currentGroup = $row['ClassGroupName'];

        echo "<h3>" . htmlspecialchars($currentGroup) . "</h3>";
        // echo $tableId;
        echo
        "<table class='table table-striped table-hover table-bordered'>
    <thead>
      <tr>
        <th>ลำดับ</th>
        <th>รหัสวิชา</th>
        <th>ชื่อวิชา</th>
        <th>ท</th>
        <th>ป</th>
        <th>น</th>
      </tr>
    </thead>
    <tbody>";
        $i++; // เพิ่มตัวนับ id
      }

      // แสดงข้อมูลในแถวของตาราง
      echo "<tr>
        <td class='day-name'>" . $i . "</td>
        <td class='day-name text-start'>" . htmlspecialchars($row['SubjectCode']) . "</td>
        <td class='text-start'>" . htmlspecialchars($row['SubjectName']) . "</td>
        <td class='day-name'>" . htmlspecialchars($row['TheoryHours']) . "</td>
        <td class='day-name'>" . htmlspecialchars($row['PracticalHours']) . "</td>
        <td class='day-name'>" . htmlspecialchars($row['CreditHours']) . "</td>
      </tr>";
    }

    // ปิดตารางสุดท้าย
    if ($currentGroup !== "") {
      echo "
  </table>";
    } else {
      echo "<div class='alert alert-warning'>ไม่มีข้อมูล</div>";
    }
    echo '</div>';
  }
}
