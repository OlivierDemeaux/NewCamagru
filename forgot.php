<?php include('connection.php'); ?>
<?php
if ($_SESSION['id'] != 'new_user')
{
	header('Location: signed_in.php');
	exit;
}
if (isset($_POST['email']) && $_POST['email'] != "")
{
	$req = $bdd->prepare('SELECT id FROM users WHERE email = ?');
	$req->execute(array($_POST["email"]));
	if($req->rowCount() == 1)
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array();
		$alphaLength = strlen($alphabet) - 1;
		for ($i = 0; $i < 18; $i++)
		{
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		$pass = implode($pass);
		$msg = $pass." is your new password, change it as soon as possible !";
		mail($_POST['email'], 'Password reset', $msg);
		$req = $bdd->prepare('UPDATE users SET password = ? WHERE email = ?');
		$hash = hash('whirlpool', $pass);
		$req->execute(array($hash, $_POST["email"]));
		header('Location: forgot_redirect.php');
		exit;
	}
	else
		echo "<style>#wrong_email { display: block; } </style>";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
    <script scr="camagruJS.js"></script>
		<link rel="stylesheet" type="text/css" href="camagru.css">
  </head>
  <body>
  <?php include_once('header.php'); ?></br></br></>
</br></br></br></br>
<div class="forgot">
        <form action="forgot.php" method="post">
            <input class="login" type="email" name="email" placeholder="Email" required />
                <br />
                <br />
                <input class="submit" type="submit" value="Reset My Password" />
        </form>
			</div>
		</body>
	</html>
	<?php include_once('footer.php') ?>
