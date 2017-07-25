<?php
$nazwa = $_POST['nazwa'];
header("Cache-control: private");
header("Content-Type: txt");
header("Content-Length: 50");
header("Content-Disposition: attachment; filename=\"".test.".".txt."\"");
readfile("attachments/".$nazwa);
?>