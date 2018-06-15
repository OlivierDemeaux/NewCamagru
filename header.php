<?php include_once('head.php')?>
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
