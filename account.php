<?php include_once('connection.php'); ?>
<?php
if ($_SESSION['id'] == 'new_user')
{
	header('Location: ./not_signed_in.php');
	exit;
}
$req = $bdd->prepare('SELECT notification FROM users WHERE id = ?');
$req->execute(array($_SESSION['id']));
$data = $req->fetch();
if ($data['notification'] == 0)
{
	$value = "OFF";
}
else
{

	$value = "ON";
}
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Camagru</title>
  <script src="camagruJS.js"></script>
	<link rel="stylesheet" type="text/css" href="camagru.css">
</head>
<body>
	<?php include('header.php'); ?>
</br></br></br>
    <div class="box_big_message">
      <a class="panel" href="./change_Username.php">Change Username</a><br/><br/>
      <a class="panel" href="./change_Password.php">Change Password</a><br/><br/>
      <a class="panel" href="./change_Email.php">Change E-mail</a><br/><br/>
      <a class="panel">Notifications</a>
      <div onclick="onOff();" id="on_off" class="on_off"><?php echo $value ?></div>
    </div>
	</body>
</html>
<?php include_once('footer.php') ?>
