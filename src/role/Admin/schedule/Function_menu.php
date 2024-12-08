<?php
function renderMenuLinks($currentGroup)
{
  $groupNames = ['ปวช.1/1', 'ปวช.2/1', 'ปวช.3/1', 'ปวช.3/2', 'ปวส.1/1', 'ปวส.2/1', 'ปวส.2/2'];

  echo "<ul class='nav nav-pills mb-3'>";
  foreach ($groupNames as $groupName) {
    $activeClass = ($currentGroup === $groupName) ? 'active' : '';
    echo "<li class='nav-item'>
      <a class='nav-link btn btn-light text-dark $activeClass' href='?group=" . urlencode($groupName) . "'>$groupName</a>
    </li>";
  }
  echo "</ul>";
}
