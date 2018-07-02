<?php include('connection.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
    <script src="camagruJS.js"></script>
    <link rel="stylesheet" type="text/css" href="camagru.css">
  </head>
  <body>
    <?php include_once('header.php'); ?></br></br>
    <?php
$text = "This account could not be confirmed.";
if ($_SESSION['id'] != "new_user")
      $text = "You can't access this page if you are already registered.";
if (isset($_GET['r']) && $_GET['r'] != "")
{
	$req = $bdd->prepare('SELECT id FROM users WHERE id = ? AND confirmed = 0');
	$req->execute(array($_GET['r']));
	if($req->rowCount() == 1)
	{
		$req = $bdd->prepare('UPDATE users SET confirmed = 1 WHERE id = ?');
		$req->execute(array($_GET['r']));
		$text =  "Your account is now confirmed, you may now sign in.";
	}
}
?>
    <div class="box_big_message">
      <?php echo $text; ?>
      <br/><br/><br/><br/>
      <a style="color: black;" href="./login.php">Go to the loggin page by clicking here</a>
    </div>
  </body>
</html>
<?php include_once('footer.php') ?>
