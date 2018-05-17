<?php
include('connexion.php');

	//$filter = htmlspecialchars($_POST['filter']);
	$img = $_POST['img'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$img = base64_decode($img);
	$im = imagecreatefromstring($img);
		$link .= uniqid();
		$link .= '.png';
		file_put_contents('../storage/'.$link, $img);
	}
	$req = $bdd->prepare('INSERT INTO pictures (picture, id_user) VALUES (:picture, :id_user)');
	$req->execute(array(
		'picture' => $link,
		'id_user' => $_SESSION['id']
	));
	$req = $bdd->prepare('SELECT * FROM pictures WHERE id_user = ? ORDER BY date_pic DESC');
			$req->execute(array($_SESSION['id']));
			while ($data = $req->fetch())
			{
    			echo '<div class="my_pictcure" id="' . $data['id_picture'] . '">
    						<img src="data/'.$data['picture'].'" alt="img" class="my_img_picture" />
							<img src="assets/icon/garbage.svg" alt="garbage" class="garbage" onclick="delete_picture(' . $data['id_picture'] . ')"/>
					</div>';
			}
?>
