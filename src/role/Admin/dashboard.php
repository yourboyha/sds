<?php
require 'chkadmin.php';

?>
<div id="content">
  <div class="container mt-5">
    <h1 class="text-center">ยินดีต้อนรับผู้ดูแลระบบ</h1>
    <div class="mb-4">
      <h2>จัดการข้อมูลพื้นฐาน</h2>


      <div class="mb-4">
        <div>
          <h4>ส่วนข้อมูลผู้ใช้งาน</h4>
          <div class="d-flex justify-content-between gap-5">
            <a href="?page=admin-member" class="btn btn-info btn-lg flex-fill">จัดการผู้ใช้งาน</a>
            <a href="?page=admin-member-role" class="btn btn-info btn-lg flex-fill">จัดการสิทธิ์ผู้ใช้งาน</a>
          </div>
        </div>
      </div>

      <div class="mb-4">
        <h4>ส่วนแผนการเรียน</h4>
        <div>
          <div class="d-flex justify-content-between gap-5">
            <a href="?page=admin-studyplan" class="btn btn-info btn-lg w-100">จัดการแผนการเรียน</a>
          </div>
        </div>
      </div>

      <div class="mb-4">
        <div class="d-flex justify-content-between gap-5">
          <h4>ส่วนแผนกวิชา</h4>
          <h4 class="ms-auto">ส่วนรายวิชา</h4> <!-- ใช้ ms-auto เพื่อให้ "ส่วนรายวิชา" ชิดซ้ายสุด -->
        </div>
        <div class="d-flex justify-content-between gap-5">
          <a href="?page=admin-department" class="btn btn-info btn-lg w-100">จัดการแผนกวิชา</a>
          <a href="?page=admin-subject" class="btn btn-info btn-lg w-100">จัดการรายวิชา</a>
        </div>
      </div>
      <div class="mb-4">
        <div class="d-flex justify-content-between gap-5">
          <h4>ส่วนห้องเรียน</h4>
          <h4 class="ms-auto">ส่วนกลุ่มเรียน</h4>
        </div>
        <div class="d-flex justify-content-between gap-5">
          <a href="?page=admin-room" class="btn btn-info btn-lg w-100">จัดการห้องเรียน</a>
          <a href="?page=admin-subject" class="btn btn-info btn-lg w-100">จัดการกลุ่มเรียน</a>
        </div>
      </div>
    </div>
  </div>
  <div class="mb-4 container">
    <h2>ส่วนตารางเรียน</h2>
    <a href="?page=admin-menu-schedule" class="btn btn-info btn-lg w-100">จัดการตารางเรียน</a>
  </div>

  <div class="mb-4 container">
    <h2>ส่วนรายงานผล</h2>
    <a href="?page=admin-report" class="btn btn-info btn-lg w-100 ">ดูรายงาน</a>
  </div>