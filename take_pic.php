<div class="leftwindow">
    <div class="panel">
    <a class="panel" href="./change_Val_Account/change_Username.php">Change Username</a><br/>
    <a class="panel" href="./change_Val_Account/change_Password.php">Change Password</a><br/>
    <a class="panel" href="./change_Val_Account/change_Email.php">Change E-mail</a><br/>
    <a class="panel" href="./notif.php">Notifications</a><br/>
    <a class="panel" href="./change_param.php">Parameters</a><br/>
    <a class="panel" href="./contact_Us.php">Contact US</a><br/>
  </div>
  </div>
  <div class="rightwindow">
    <div class="items">
				<img onclick="selectItem('samurai');" id="samurai" src="images/samurai-helmet.png" class="item">
				<img onclick="selectItem('hat');" id="hat" src="images/hat.png" class="item">
				<img onclick="selectItem('saiyan');" id="saiyan" src="images/saiyan3.png" class="item">
        <img onclick="selectItem('bird');" id="bird" src="images/bird.png" class="item">
				<input onchange="uploaded(this);" disabled="disabled" id="file" class="upload" type="file" name="file">
			</div>
</div>
<div class="box_big_message">
  <div class="description">
    Here you can take pictures of yourself and <br/>add some cool filters to it!
  </br></br>
  </div>
  <div class="camera">
    <img id="helmet_filtre" src="./images/samurai-helmet.png" class="filtre">
    <img id="hat_filtre" src="./images/hat.png" class="filtre">
    <img id="saiyan_filtre" src="./images/saiyan3.png" class="filtre">
    <img id="bird_filtre" src="./images/bird.png" class="filtre">
    <video class="camera" id="camera"></video>
  </div>
  <canvas class="picture" id="canvas"></canvas>
  </br>
  <button onclick="photo();">Prendre une photo</button></div>



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
    else
    	alert("Your browser does not support getUserMedia()");
  }
    function failure(error)
  {
	   alert(error);
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
			//document.getElementById("studio_galery").innerHTML = link + document.getElementById("studio_galery").innerHTML;
			}
		};
		xhr.open("POST", "upload_pic.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("image=" + imageDataURL);
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
if (document.getElementById("samurai").classList.contains("selected") ||
  document.getElementById("hat").classList.contains("selected") ||
  document.getElementById("saiyan").classList.contains("selected") ||
  document.getElementById("bird").classList.contains("selected"))
{
  document.getElementById("button_photo").style.backgroundColor = "#00CC00";
  document.getElementById("button_photo").style.color = "white";
  document.getElementById("file").disabled = false;
}
else
{
  document.getElementById("button_photo").style.backgroundColor = "grey";
  document.getElementById("button_photo").style.color = "#CCC";
  document.getElementById("file").disabled = true;
}
}

      </script>
    </div>
</div>
