<?php include_once('../connection.php'); ?>
<?php
if ($_SESSION['id'] == 'new_user')
{
	header('Location: ../not_signed_in.php');
	exit;
}
if (isset($_POST['new_password']) && isset($_POST['password']) && isset($_POST['password_conf']) && $_POST['new_password'] != "" && $_POST['password'] != "" && $_POST['password_conf'] != "")
{
	if ($_POST['new_password'] != $_POST['password_conf'])
		echo "<style>#pass_match { display: block; } </style>";
	else if (strlen($_POST['new_password']) < 8)
		echo "<style>#short_pass { display: block; } </style>";
	else if (!preg_match("#[0-9]+#", $_POST['new_password']))
		echo "<style>#number_pass { display: block; } </style>";
	else if (!preg_match("#[a-zA-Z]+#", $_POST['new_password']))
		echo "<style>#letter_pass { display: block; } </style>";
	else
	{
		$hash = hash('whirlpool', $_POST['password']);
		$req = $bdd->prepare('SELECT id FROM users WHERE id = ? AND password = ?');
		$req->execute(array($_SESSION["id"], $hash));
		if ($req->rowCount() != 1)
			echo "<style>#wrong_pass { display: block; } </style>";
		else
		{
			$hash = hash('whirlpool', $_POST['new_password']);
			$req = $bdd->prepare('UPDATE users SET password = ? WHERE id = ?');
			$req->execute(array($hash, $_SESSION["id"]));
			header('Location: ../redirect/password_redirect.php');
			exit;
		}
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
	<?php include('../header.php'); ?>
	<div class="login_box">
		<span id="wrong_pass" class="error_msg">Wrong password</span>
		<span id="pass_match" class="error_msg">Passwords don't match</span>
		<span id="short_pass" class="error_msg">Password too short</span>
		<span id="number_pass" class="error_msg">Password must include a number</span>
		<span id="letter_pass" class="error_msg">Password must include a letter</span>
		<form action="change_Password.php" method="post">
      <input class="login" type="password" name="password" placeholder="Old Password" required />
      <br />
      <input class="login" type="password" name="new_password" placeholder="New Password" required />
			<br />
			<input class="login" type="password" name="password_conf" placeholder="Confirmation" required />
			<br />
			<br />
			<input class="submit" type="submit" value="Modify" />
		</form>
	</div>
</body>
</html>
