<?php include_once('connection.php'); ?>
<?php
if ($_SESSION['id'] != 'new_user')
{
	header('Location: signed_in.php');
	exit;
}
if (isset($_POST['login']) && isset($_POST['password']) && $_POST['login'] != "" && $_POST['password'] != "")
{
	$hash = hash('whirlpool', $_POST['password']);
	$req = $bdd->prepare('SELECT id, confirmed FROM users WHERE login = ? AND password = ?');
	$req->execute(array($_POST["login"], $hash));
	if($req->rowCount() == 1)
	{
		$data = $req->fetch();
		if ($data['confirmed'] == 0)
			echo "This account isn't confirmed";
		else
		{
			$_SESSION['id'] = $data['id'];
			header('Location: index.php');
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
	<link rel="stylesheet" type="text/css" href="camagru.css">
</head>
<body>
	<?php include('header.php'); ?></br></br></br>
	<div class="box_big_message">
		You need to sign in or log in if you want to like a picture
	</div>
</body>
</html>
<?php include_once('footer.php') ?>
