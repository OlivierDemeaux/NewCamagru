
<?php include('connection.php'); ?>
<?php
if (isset($_POST['id']) && $_POST['id'] != "")
{
	if ($_SESSION['id'] == "new_user")
	{
		echo "log";
		exit;
	}
	$req = $bdd->prepare('DELETE FROM comments WHERE id = ?');
	$req->execute(array($_POST['id']));
	echo "ok";
	exit;
}
else
	echo "error";
?>
