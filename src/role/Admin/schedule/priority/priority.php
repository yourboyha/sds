<?php
include '../../../../Controller/connect.php';

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL ดึงข้อมูลรายวิชา
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

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $currentGroup = ""; // กลุ่มเรียนปัจจุบัน
  $i = 1;

  echo '<div class="d-flex justify-content-center gap-3 mb-3">';
  echo '<button class="btn btn-outline-danger w-50" onclick="showSection(\'checksubject\', \'src/role/Admin/schedule/checksubject/checksubject.php\')">ย้อนกลับ</button>';
  echo '<button class="btn btn-outline-success w-50" onclick="showSection(\'subjecttype\', \'src/role/Admin/schedule/subjecttype/subjecttype.php\')">ถัดไป</button>';
  echo '</div>';

  echo '<div class="container">';
  while ($row = $result->fetch_assoc()) {
    // เมื่อ ClassGroup เปลี่ยน ให้เริ่มตารางใหม่
    if ($currentGroup !== $row['ClassGroupName']) {
      if ($currentGroup !== "") {
        echo '</tbody></table>'; // ปิดตารางก่อนหน้า
        $i = 1;
      }
      $currentGroup = $row['ClassGroupName'];
      echo '<h3>' . htmlspecialchars($currentGroup) . '</h3>';
      echo '
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รหัสวิชา</th>
                        <th>ชื่อวิชา</th>
                        <th>ท</th>
                        <th>ป</th>
                        <th>น</th>
                        <th>แยกคาบ</th>
                        <th colspan="5">ระดับความสำคัญ</th>
                    </tr>
                    <tr>
                        <th colspan="7"></th>
                        <th>5</th>
                        <th>4</th>
                        <th>3</th>
                        <th>2</th>
                        <th>1</th>
                    </tr>
                </thead>
                <tbody>';
    }

    // แสดงข้อมูลวิชาในแต่ละแถว
    echo '<tr>
            <td>' . $i . '</td>
            <td>' . htmlspecialchars($row['SubjectCode']) . '</td>
            <td>' . htmlspecialchars($row['SubjectName']) . '</td>
            <td>' . $row['TheoryHours'] . '</td>
            <td>' . $row['PracticalHours'] . '</td>
            <td>' . $row['CreditHours'] . '</td>
            <td><input type="checkbox" class="priority-checkbox" data-subject="' . htmlspecialchars($row['SubjectCode']) . '"></td>';

    for ($level = 5; $level >= 1; $level--) {
      echo '<td class="priority">
                <input type="radio" name="priority_' . htmlspecialchars($row['SubjectCode']) . '" value="' . $level . '">
            </td>';
    }
    echo '</tr>';
    $i++;
  }
  echo '</tbody></table>';
  echo '</div>';
} else {
  echo '<div class="alert alert-warning">ไม่มีข้อมูล</div>';
}

$conn->close();
?>

<script>
// ฟังก์ชันจัดการการคลิก Checkbox
document.querySelectorAll('.priority-checkbox').forEach(checkbox => {
  checkbox.addEventListener('change', function() {
    console.log(`วิชา ${this.dataset.subject} ถูกเปลี่ยนสถานะ: ${this.checked ? 'เลือก' : 'ไม่เลือก'}`);
  });
});
</script>