<?php include_once('connection.php') ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Camagru</title>
    <script src="camagruJS.js"></script>
    <link rel="stylesheet" type="text/css" href="camagru.css">
  </head>
  <body onload="streaming('<?php echo $_SESSION['id'] ?>');">
    <?php include_once('header.php') ?>
  </br>
    <?php if ($_SESSION['id'] != "new_user")
              include_once('take_pic.php');
          else
              include_once('main_Page.php');
      ?>
  </body>
</html>
<?php include_once('footer.php') ?>
