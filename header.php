<div class="header">
  <ul>
  <a href="/">Camagru</a>
  <a href="./register.php">Register</a>
  <a href="./login.php">Login</a>
  <?php
      if ($_SESSION['id'] != "new_user")
      {
        ?>
        <a href="./photobooth.php">PhotoBooth</a>
        <a href="./account.php">Account</a>
        <?php
      }
  ?>
  <ul>
</div>
