<?php include('connection.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
    <script scr="camagruJS.js"></script>
    <link rel="stylesheet" type="text/css" href="camagru.css">
  </head>
  <body  onload="streaming();">
    <div class="box_big_message">
      <div class="description">
          Here you can take pictures of yourself and <br/>add some cool filters to it!
          </br></br>
      </div>
    <div class="camera">
    <img id="tree_filtre" src="./images/tree.png" class="filtre">
    <img id="hat_filtre" src="./images/hat.png" class="filtre">
    <img id="saiyan_filtre" src="./images/saiyan3.png" class="filtre">
    <img id="bird_filtre" src="./images/bird.png" class="filtre">
    <video class="camera" id="camera"></video>

    <canvas class="picture" id="canvas"></canvas>
    </br>
    <button id="button_photo" onclick="photo();">Prendre une photo</button>
  </div>
  <div class="rightwindow">
      <div class="items">
  				<img onclick="selectItem('tree');" id="tree" src="images/tree2.png" class="item">
  				<img onclick="selectItem('hat');" id="hat" src="images/hat2.png" class="item">
  				<img onclick="selectItem('saiyan');" id="saiyan" src="images/saiyan2.png" class="item">
          <img onclick="selectItem('bird');" id="bird" src="images/bird2.png" class="item">
  				<input onchange="uploaded(this);" disabled="disabled" id="file" class="upload" type="file" name="file">
  			</div>
  </div>
  </br></br></br></br></br></br></br></br></br>

<div class = "bottom_display">
  Your Pictures: <br/>
  <div class="studio_galery" id="studio_galery">
  <?php
  				$req = $bdd->prepare('SELECT * FROM images WHERE creator = ? ORDER BY creation DESC');
  				$req->execute(array($_SESSION['id']));
  				while ($el = $req->fetch())
  				{
  					?>
  					<div id="image<?php echo $el['id'] ?>" class="studio_pictures">
  						<img class="studio_pictures" src="pictures/<?php echo $el['id'] ?>.png">
              <span style="display: inblock" onclick="deleteImage(<?php echo $el['id'] ?>)" class="delete_comment">delete</span>
  					</div>
  					<?php
  				}
          ?>
      </div>
</div>
    </div>
</body>
</html>
