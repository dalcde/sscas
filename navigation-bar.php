<?php
$pages=["Main"=>"home",
        "Input"=>"input",
        "Report"=>"report"
        ];

$admin_pages=["Settings"=>"settings",
	      "Edit Entries"=>"edit"
              ];

foreach ($pages as $name=>$page) {
  echo "<a class='menu-item' href='?p=".$page."'>".$name."</a>";
}

if (is_admin()) {
  foreach ($admin_pages as $name=>$page) {
    echo "<a class='menu-item' href='?p=".$page."'>".$name."</a>";
  }
}

echo "<a style='position: absolute; bottom: 0px' class='menu-item' href='?p=logout'>Logout</a>"
?>

