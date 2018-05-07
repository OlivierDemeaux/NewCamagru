<?php include('connection.php'); ?>
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
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
    <link rel="stylesheet" type="text/css" href="camagru.css">
  </head>
  <body>
    <?php include_once('header.php'); ?>
    <div class="box_big_message">
      <?php echo $text; ?>
    </div>
  </body>
</html>
