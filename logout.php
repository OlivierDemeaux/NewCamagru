<?php include_once('connection.php'); ?>
<?php
session_destroy();
header('Location: index.php');
exit;
?>
