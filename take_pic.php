<?php include('connection.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
    <script scr="camagruJS.js"></script>
    <link rel="stylesheet" type="text/css" href="camagru.css">
  </head>
  <body>
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
    <button onclick="photo();">Prendre une photo</button>
  </div>
<<<<<<< HEAD
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

=======
  </br></br></br></br></br></br></br></br></br>
>>>>>>> fedb7d06c3c6af3bdc8aa9a3394a7d4c5196999e
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
<<<<<<< HEAD
=======

  <script>
  function streaming()
  {
    var camera = document.getElementById("camera");
  	var constraints = {video:true};
  	navigator.getUserMedia = navigator.getUserMedia ||
  						navigator.webkitGetUserMedia ||
  						navigator.mozGetUserMedia;
    if (navigator.getUserMedia)
    		navigator.getUserMedia(constraints, success, failure);
  }
    function failure(error)
  {
	   return;
   }

   function success(stream)
  {
  	var camera = document.getElementById("camera");
  	if (camera.mozSrcObject !== undefined)
  		camera.mozSrcObject = stream;
  	else if (camera.srcObject !== undefined)
  		camera.srcObject = stream;
  	else
  		camera.src = stream;
  	camera.play();
  }

  function photo()
{
  if (document.getElementById("tree").classList.contains("selected") ||
		document.getElementById("hat").classList.contains("selected") ||
		document.getElementById("saiyan").classList.contains("selected") ||
    document.getElementById("bird").classList.contains("selected"))
    {
    	var hidden_canvas = document.getElementById('canvas')
    	var video = document.getElementById("camera");
    	width = video.videoWidth;
    	height = video.videoHeight;
    	context = hidden_canvas.getContext('2d');
    	hidden_canvas.width = width;
    	hidden_canvas.height = height;
    	context.drawImage(video, 0, 0, width, height);
    	var imageDataURL = hidden_canvas.toDataURL('image/png');
    	var xhr = new XMLHttpRequest();
    	xhr.onreadystatechange = function() {
    		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
    			var link = xhr.responseText;
    			if (link == "error")
    				return;
    		document.getElementById("studio_galery").innerHTML = link + document.getElementById("studio_galery").innerHTML;
    		}
    	};
    	xhr.open("POST", "upload_pic.php", true);
    	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      var tree = 0;
      var hat = 0;
      var saiyan = 0;
      var bird = 0;
      if (document.getElementById("tree").classList.contains("selected"))
    		tree = 1;
    	if (document.getElementById("hat").classList.contains("selected"))
    		hat = 1;
    	if (document.getElementById("saiyan").classList.contains("selected"))
    		saiyan = 1;
      if (document.getElementById("bird").classList.contains("selected"))
    		bird = 1;
    	xhr.send("image=" + imageDataURL + "&tree=" + tree + "&hat=" + hat + "&saiyan=" + saiyan + "&bird=" + bird);
  }
}

function selectItem(name)
{
var item = document.getElementById(name);
if (item.classList.contains("selected"))
{
  item.classList.remove("selected");
  document.getElementById(name + "_filtre").style.display = "none";
}
else
{
  item.classList.add("selected");
  document.getElementById(name + "_filtre").style.display = "block";
}
// if (document.getElementById("samurai").classList.contains("selected") ||
//   document.getElementById("hat").classList.contains("selected") ||
//   document.getElementById("saiyan").classList.contains("selected") ||
//   document.getElementById("bird").classList.contains("selected"))
// {
//   document.getElementById("button_photo").style.backgroundColor = "#00CC00";
//   document.getElementById("button_photo").style.color = "white";
//   document.getElementById("file").disabled = false;
// }
// else
// {
//   document.getElementById("button_photo").style.backgroundColor = "grey";
//   document.getElementById("button_photo").style.color = "#CCC";
//   document.getElementById("file").disabled = true;
// }
}


      </script>
    </div>
>>>>>>> fedb7d06c3c6af3bdc8aa9a3394a7d4c5196999e
</div>
</body>
</html>
