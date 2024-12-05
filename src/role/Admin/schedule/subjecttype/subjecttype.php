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


// รันคำสั่ง SQL และเก็บผลลัพธ์
$result = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($result->num_rows > 0) {
  $currentGroup = ""; // เก็บชื่อกลุ่มปัจจุบัน
  $i = 1;
  echo '<span class="text-dark fw-bold">เลือกดูระดับชั้น :</span>';
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
      <th  style="width: 6%;">ลำดับ</th>
      <th  style="width: 10%;">รหัสวิชา</th>
      <th  style="width: 20%;">ชื่อวิชา</th>
      <th  style="width: 4%;">ท</th>
      <th  style="width: 4%;">ป</th>
      <th  style="width: 4%;">น</th>
      <th  style="width: 6%;">แยกคาบ</th>
      <th  style="width: 5%;">ความสำคัญ</th>
      <th  style="width: 10%;">ทฤษฎี / ปฎิบัติ</th>
      <th  style="width: 35%;">ประเภทวิชา</th>
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
        <input type="checkbox" id="myCheckbox" onclick="toggleCheckbox()" checked disabled>
      </td>
      <td>5</td>
      <td>ปฎิบัติ</td>
      <td>    
        <select id="subjecttype" name="subjecttype" class="form-select">
          <option value="1">วิชาชีพ</option>
          <option value="2">วิชาชีพ/เรียนร่วม</option>
          <option value="3">วิชาชีพฝึกงาน</option>
          <option value="4">วิชาสามัญ/เรียนร่วม</option>
          <option value="5">กิจกรรม/เรียนร่วม</option>
        </select>
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
