<?php
date_default_timezone_set("Europe/Paris");
try
{
  include_once('config/database.php');
	$bdd = new PDO("mysql:dbname=camagru;host=127.0.0.1", $DB_USER, $DB_PASSWORD);
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$bdd->exec("SET NAMES 'UTF8'");
}
catch (Exception $e)
{
	header('Location: /error.php');
	exit;
}
session_start();
if(!isset($_SESSION['id']))
  $_SESSION['id'] = "new_user";
else if ($_SESSION['id'] != "new_user")
{
  $req = $bdd->prepare('SELECT notification FROM users WHERE id = ?');
  $req->execute(array($_SESSION['id']));
  if ($req->rowCount() != 1)
    $_SESSION['id'] = "new_user";
}
?>
