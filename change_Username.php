<?php include_once('./connection.php'); ?>
<?php
if ($_SESSION['id'] == 'new_user')
{
	header('Location: ./not_signed_in.php');
	exit;
}
if (isset($_POST['login']) && isset($_POST['password']) && $_POST['login'] != "" && $_POST['password'] != "")
{
	$req = $bdd->prepare('SELECT id FROM users WHERE login = ?');
	$req->execute(array($_POST["login"]));
	if ($req->rowCount() > 0)
		echo "<style>#login_used { display: block; } </style>";
	else
	{
		$hash = hash('whirlpool', $_POST['password']);
		$req = $bdd->prepare('SELECT id FROM users WHERE id = ? AND password = ?');
		$req->execute(array($_SESSION["id"], $hash));
		if($req->rowCount() == 1)
		{
			$req = $bdd->prepare('UPDATE users SET login = ? WHERE id = ?');
			$req->execute(array($_POST['login'], $_SESSION["id"]));
			header('Location: ./login_redirect.php');
			exit;
		}
		else
			echo "<style>#wrong_pass { display: block; } </style>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Camagru</title>
	<link rel="stylesheet" type="text/css" href="./camagru.css">
</head>
<body>
	<?php include('./header.php'); ?></br></br>
  <div class="login_box">
		<span id="login_used" class="error_msg">Login already used</span>
		<span id="wrong_pass" class="error_msg">Wrong password</span>
		<form action="change_Username.php" method="post">
			<input class="login" type="text" name="login" placeholder="New Login" required />
			<br />
			<input class="login" type="password" name="password" placeholder="Password" required />
			<br />
			<br />
			<input class="submit" type="submit" value="Modify" />
		</form>
	</div>
</body>
</html>
<?php include_once('footer.php') ?>
