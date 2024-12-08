<?php

if ($_SESSION['role'] !== 'admin') {
  header("Location: /sds/index.php?page=login");
  exit();
}
