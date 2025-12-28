<?php
session_start();
session_destroy();
unset($_SESSION['Email']);
header("Location: /testmnm/index.php");
exit;
?>