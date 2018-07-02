<?php include('connection.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru</title>
    <script scr="camagruJS.js"></script>
    <link rel="stylesheet" type="text/css" href="./camagru.css">
  </head>
  <body>
    <?php include_once('header.php'); ?></br></br>
    <div class="box_big_message">
        </br></br></br></br>
    <?php
    if ($_SESSION['id'] == "new_user")
    {
    	echo "log";
    	exit;
    }
    $req = $bdd->prepare('SELECT notification FROM users WHERE id = ?');
    $req->execute(array($_SESSION['id']));
    $data = $req->fetch();
    if ($data['notification'] == 0)
    {
      $req = $bdd->prepare('UPDATE users SET notification = 1 WHERE id = ?');
      $req->execute(array($_SESSION['id']));
      echo "lol";
      exit;
    }
    else
    {
      $req = $bdd->prepare('UPDATE users SET notification = 0 WHERE id = ?');
      $req->execute(array($_SESSION['id']));
      echo "off";
      exit;
    }
    ?>
  </div>
  </body>
</html>
<?php include_once('footer.php') ?>
