<?php include_once('connection.php') ?>
<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
    <?php include_once('header.php') ?>
    <?php if ($_SESSION['id'] != "new_user")
              include_once('take_pic.php');
          else
              include_once('main_Page.php');?>
  </body>
</html>
