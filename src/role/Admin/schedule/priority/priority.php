<?php
include '../../../../Controller/connect.php';
// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
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
include '../btnsch.php';

// รันคำสั่ง SQL และเก็บผลลัพธ์
$result = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($result->num_rows > 0) {
  $currentGroup = ""; // เก็บชื่อกลุ่มปัจจุบัน
  $i = 1;
  echo '<span class="text-dark fw-bold">เลือกระดับชั้น :</span>';
  // สร้างเมนูลิงก์นำทางเพียงครั้งเดียว
  $menuLinks = "<ul class='nav nav-pills mb-3'>";

  $groupNames = ['ปวช.1/1', 'ปวช.2/1', 'ปวช.3/1', 'ปวช.3/2', 'ปวส.1/1', 'ปวส.2/1', 'ปวส.2/2'];
  foreach ($groupNames as $groupName) {
    $menuLinks .= "<li class='nav-item'>
    <a class='nav-link btn btn-light text-dark' href='#" . urlencode($groupName) . "'>" . $groupName . "</a>
  </li>";
  }
  $menuLinks .= "</ul>";
  // แสดงเมนูนำทาง
  echo $menuLinks;

  // วนลูปข้อมูลเพื่อสร้างเนื้อหา
  while ($row = $result->fetch_assoc()) {
    // เริ่มต้นตารางใหม่หาก ClassGroupName เปลี่ยน
    if ($currentGroup !== $row['ClassGroupName']) {
      // ปิดตารางก่อนหน้า
      if ($currentGroup !== "") {
        echo '</table>';
        $i = 1;
      }

      // แสดงชื่อกลุ่มใหม่
      $currentGroup = $row['ClassGroupName'];
      echo '<h3 id="' . urlencode($currentGroup) . '">' . $currentGroup . '</h3>';

      echo
      '<table class="table table-striped table-hover table-bordered">
  <thead>
    <tr>
      <th rowspan="2"style="width: 6%;">ลำดับ</th>
      <th rowspan="2"style="width: 10%;">รหัสวิชา</th>
      <th rowspan="2" style="width: 20%;">ชื่อวิชา</th>
      <th rowspan="2"style="width: 4%;">ท</th>
      <th rowspan="2"style="width: 4%;">ป</th>
      <th rowspan="2"style="width: 4%;">น</th>
      <th rowspan="2"style="width: 6%;">แยกคาบ</th>
      <th colspan="5" style="width: 50%;">ระดับความสำคัญ</th>
    </tr>
        <tr>

      <th>5</th>
      <th>4</th>
      <th>3</th>
      <th>2</th>
      <th>1</th>
    </tr>
  </thead>
  <tbody>';
    }

    // แสดงข้อมูลในแถวของตาราง
    echo '<tr>
      <td>' . $i . '</td>
      <td class="day-name text-start">' . $row['SubjectCode'] . '</td>
      <td class="text-start">' . $row['SubjectName'] . '</td>
      <td>' . $row['TheoryHours'] . '</td>
      <td>' . $row['PracticalHours'] . '</td>
      <td>' . $row['CreditHours'] . '</td>
      <td>
        <input type="checkbox" id="myCheckbox" onclick="toggleCheckbox()">
      </td>
      <td class="priority priority-5">
        <input type="radio" name="' . $row['SubjectCode'] . '" id="' . $row['SubjectCode'] . ',5" value="5">
      </td>
      <td class="priority priority-4">
        <input type="radio" name="' . $row['SubjectCode'] . '" id="' . $row['SubjectCode'] . ',4" value="4">
      </td>
      <td class="priority priority-3">
        <input type="radio" name="' . $row['SubjectCode'] . '" id="' . $row['SubjectCode'] . ',3" value="3">
      </td>
      <td class="priority priority-2">
        <input type="radio" name="' . $row['SubjectCode'] . '" id="' . $row['SubjectCode'] . ',2" value="2">
      </td>
      <td class="priority priority-1">
        <input type="radio" name="' . $row['SubjectCode'] . '" id="' . $row['SubjectCode'] . ',1" value="1">
      </td>
    </tr>';
    $i++;
  }

  // ปิดตารางสุดท้าย
  echo '</tbody>
</table>';
} else {
  echo '<div class="alert alert-warning">ไม่มีข้อมูล</div>';
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();

?>

<script>
  function setValue(radio) {
    function toggleCheckbox() {
      const checkbox = document.getElementById("myCheckbox");
      if (checkbox.checked) {
        checkbox.value = 1; // Set value to 1 when checked
      } else {
        checkbox.value = 0; // Set value to 0 when unchecked
      }
      console.log("Checkbox is now:", checkbox.value);
    }
  }
</script>