<?php
if ($_SESSION['role'] !== 'admin' || !isset($_GET['id'])) {
  header("Location: /sds/index.php?page=login");
  exit();
}
