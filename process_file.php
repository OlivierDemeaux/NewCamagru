<?php include('connection.php'); ?>
<?php
if (isset($_FILES['file']) && isset($_POST['tree']) && isset($_POST['hat']) && isset($_POST['saiyan']) && isset($_POST['bird']) && $_FILES['file'] != "" && $_POST['tree'] != "" && $_POST['hat'] != "" && $_POST['saiyan'] != "" && $_POST['bird'] != "" && $_SESSION['id'] != 'new_user')
{
	if ($_POST['tree'] == 0 && $_POST['hat'] == 0 && $_POST['saiyan'] == 0 && $_POST['bird'] == 0)
	{
		echo "error";
		exit;
	}
	$fileName = $_FILES['file']['name'][0];
	$fileLoc = $_FILES['file']['tmp_name'][0];
	$fileType = $_FILES['file']['type'][0];
	$fileSize = $_FILES['file']['size'][0];
	$fileError = $_FILES['file']['error'][0];
	$extension = pathinfo($fileName, PATHINFO_EXTENSION);
	if ($extension != "png")
	{
		echo "error";
		exit;
	}
	$req = $bdd->prepare('INSERT INTO images (creator, creation) VALUES (:creator, :creation)');
	$req->execute(array(
		'creator' => $_SESSION['id'],
		'creation' => time()
		));
	$id = $bdd->lastInsertId();
	move_uploaded_file($fileLoc, 'pictures/'.$id.'.png');
	$image_1 = imagecreatefrompng('pictures/'.$id.'.png');
	imagealphablending($image_1, true);
	imagesavealpha($image_1, true);
	$dw = imagesx($image_1);
	$dh = imagesy($image_1);
	if ($_POST['tree'] == 1)
	{
		$image_2 = imagecreatefrompng('images/tree.png');
		$w = imagesx($image_2);
		$h = imagesy($image_2);
		imagecopyresampled($image_1, $image_2, 0, 0, 0, 0, $dw, $dh, $w, $h);
	}
	if ($_POST['hat'] == 1)
	{
		$image_2 = imagecreatefrompng('images/hat.png');
		$w = imagesx($image_2);
		$h = imagesy($image_2);
		imagecopyresampled($image_1, $image_2, 0, 0, 0, 0, $dw, $dh, $w, $h);
	}
	if ($_POST['saiyan'] == 1)
	{
		$image_2 = imagecreatefrompng('images/saiyan3.png');
		$w = imagesx($image_2);
		$h = imagesy($image_2);
		imagecopyresampled($image_1, $image_2, 0, 0, 0, 0, $dw, $dh, $w, $h);
    }
    if ($_POST['bird'] == 1)
	{
		$image_2 = imagecreatefrompng('images/bird.png');
		$w = imagesx($image_2);
		$h = imagesy($image_2);
		imagecopyresampled($image_1, $image_2, 0, 0, 0, 0, $dw, $dh, $w, $h);
	}
	imagepng($image_1, 'pictures/'.$id.'.png');
	header('Content-Type: text/plain');
	?>
	<div id="image<?php echo $id ?>" class="studio_pictures">
		<img class="studio_pictures" src="pictures/<?php echo $id ?>.png">
		<span style="margin-top: -2px" onclick="deleteImage(<?php echo $id ?>)" class="delete_comment">delete</span>
	</div>
	<?php
}
else
	echo "error";
?>
