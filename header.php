<html>
  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
    <link rel="stylesheet" type="text/css" href="camagru.css">
  </head>
  <body>
    <div class="header">
      <ul>
        <a href="/">Camagru</a>
          <?php
          if ($_SESSION['id'] == "new_user")
          {
          ?>
            <a href="./register.php">Register</a>
            <a href="./login.php">Login</a>
          <?php
          }
          ?>
          <?php
          if ($_SESSION['id'] != "new_user")
          {
          ?>
            <a href="./gallery.php">Gallery</a>
            <a href="./account.php">Account</a>
            <a href="./logout.php">Logout</a>
          <?php
          }
        ?>
      <ul>
    </div>
  </body>
</html>
