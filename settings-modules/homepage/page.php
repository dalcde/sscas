<?php
$PAGES=['save-file',
        'add-student-record',
        'time-property',
        'user-accounts'];
foreach ($PAGES as $PAGE) {
 echo "<a href='?p=settings&mod=".$PAGE."'>".$PAGE."</a><br />";
}
?>
