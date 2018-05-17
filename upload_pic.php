<?php include('connection.php'); ?>
<?php
$req = $bdd->prepare('INSERT INTO images (creator, creation) VALUES (:creator, :creation)');
	$req->execute(array(
		'creator' => $_SESSION['id'],
		'creation' => time()
		));
	$id = $bdd->lastInsertId();
	$img = $_POST['image'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$img = base64_decode($img);
	file_put_contents('pictures/'.$id.'.png', $img);
	$image_1 = imagecreatefrompng('pictures/'.$id.'.png');
	imagealphablending($image_1, true);
	imagesavealpha($image_1, true);
	$dw = imagesx($image_1);
	$dh = imagesy($image_1);
	imagepng($image_1, 'pictures/'.$id.'.png');
	header('Content-Type: text/plain');
    ?>
