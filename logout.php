<?php
session_start();
session_destroy();
header("Location: index.html"); // or login.php
exit();
?>
