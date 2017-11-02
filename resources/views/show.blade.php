<?php

header("Content-Type: text/plain");
?>
<?php
echo '<html><head><title>';
echo $info->title;
echo '</title></head><body>';
?>

<?php
echo $info->text;
?>
<?php
 echo '</p></body></html>';
?>
