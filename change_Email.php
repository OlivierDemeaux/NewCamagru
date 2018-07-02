<?php include_once('./connection.php'); ?>
<?php
if ($_SESSION['id'] == 'new_user')
{
	header('Location: ./not_signed_in.php');
	exit;
}
if (isset($_POST['email']) && isset($_POST['password']) && $_POST['email'] != "" && $_POST['password'] != "")
{
	$req = $bdd->prepare('SELECT id FROM users WHERE email = ?');
	$req->execute(array($_POST["email"]));
	if ($req->rowCount() > 0)
		echo "<style>#email_used { display: block; } </style>";
  else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		echo "<style>#email_format { display: block; } </style>";
  else
	{
		$hash = hash('whirlpool', $_POST['password']);
		$req = $bdd->prepare('SELECT id FROM users WHERE id = ? AND password = ?');
		$req->execute(array($_SESSION["id"], $hash));
		if($req->rowCount() == 1)
		{
			$req = $bdd->prepare('UPDATE users SET email = ? WHERE id = ?');
			$req->execute(array($_POST['email'], $_SESSION["id"]));
			header('Location: ./email_redirect.php');
			exit;
		}
		else
			echo "<style>#wrong_email { display: block; } </style>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Camagru</title>
	<link rel="stylesheet" type="text/css" href="../camagru.css">
</head>
<body>
	<?php include('./header.php'); ?></br></br>
  <div class="login_box">
		<span id="email_used" class="error_msg">Email already used</span>
		<span id="wrong_email" class="error_msg">Wrong Email or wrong Password</span>
		<form action="change_Email.php" method="post">
			<input class="login" type="text" name="email" placeholder="New Email" required />
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
