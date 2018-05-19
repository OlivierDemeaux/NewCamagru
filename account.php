<?php include_once('connection.php'); ?>
<?php
if ($_SESSION['id'] == 'new_user')
{
	header('Location: ./not_signed_in.php');
	exit;
}
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Camagru</title>
	<link rel="stylesheet" type="text/css" href="camagru.css">
</head>
<body>
	<?php include('header.php'); ?>
    <div class="box_big_message">
      <a class="panel" href="./change_Val_Account/change_Username.php">Change Username</a><br/><br/>
      <a class="panel" href="./change_Val_Account/change_Password.php">Change Password</a><br/><br/>
      <a class="panel" href="./change_Val_Account/change_Email.php">Change E-mail</a><br/><br/>
      <a class="panel" href="./notif.php">Notifications</a><br/><br/>
      <a class="panel" href="./change_param.php">Parameters</a><br/><br/>
      <a class="panel" href="./contact_Us.php">Contact US</a><br/><br/>
    </div>
