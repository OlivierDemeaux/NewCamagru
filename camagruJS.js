var limit = 5;

function streaming(id)
{
  if (id == "new_user")
    return;
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
   return;
}

function success(stream)
{
  var camera = document.getElementById("camera");
   if (camera.srcObject !== undefined)
     camera.srcObject = stream;
   else
     camera.src = stream;
   camera.play();
}

function deleteComment(id, img)
{
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			var link = xhr.responseText;
			if (link == "error")
				return;
			if (link == "log")
			{
				window.location.href = "signin.php";
				return;
			}
			var elem = document.getElementById("comment" + id);
			elem.parentNode.removeChild(elem);
			document.getElementById("nbr_comments" + img).textContent = parseInt(document.getElementById("nbr_comments" + img).textContent) - 1;
		}
	};
	xhr.open("POST", "delete_comment.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("id=" + id);
}


function postComment(id)
{
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			var link = xhr.responseText;
			if (link == "error")
				return;
			if (link == "log")
			{
				window.location.href = "signin.php";
				return;
			}
			var res = link.split(";");
			var elem = document.createElement("div");
			elem.setAttribute("class", "comment");
			elem.setAttribute("id", "comment" + res[1]);
			elem.innerHTML = res[0] + " :<br />" + comment;
			elem.innerHTML += "<span onclick=\"deleteComment(" + res[1] + ", " + id + ")\" class=\"delete_comment\">delete</span>";
			document.getElementById("comments" + id).appendChild(elem);
			document.getElementById("new_comment" + id).value = "";
			document.getElementById("nbr_comments" + id).textContent = parseInt(document.getElementById("nbr_comments" + id).textContent) + 1;
		}
	};
	var comment = document.getElementById("new_comment" + id).value;
	comment = comment.replace(/\n/g, '<br />')
	xhr.open("POST", "add_comment.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("id=" + id + "&comment=" + comment);
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

function likeImage(id)
{
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			var link = xhr.responseText;
			if (link == "error")
				return;
			if (link == "log")
			{
				window.location.href = "signin.php";
				return;
			}
			else if (link == "add")
			{
				document.getElementById("like" + id).src = "images/liked.svg";
				document.getElementById("nbr_likes" + id).textContent = parseInt(document.getElementById("nbr_likes" + id).textContent) + 1;
			}
			else if (link == "remove")
			{
				document.getElementById("like" + id).src = "images/like.svg";
				document.getElementById("nbr_likes" + id).textContent = parseInt(document.getElementById("nbr_likes" + id).textContent) - 1;
			}
		}
	};
	xhr.open("POST", "like.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("id=" + id);
}


function deleteImage(id) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
      var link = xhr.responseText;
      if (link == "error")
        return;
      if (link == "log")
      {
        window.location.href = "signin.php";
        return;
      }
      var elem = document.getElementById("image" + id);
      elem.parentNode.removeChild(elem);
    }
  };
  xhr.open("POST", "delete_image.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("id=" + id);
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
if (document.getElementById("tree").classList.contains("selected") ||
  document.getElementById("hat").classList.contains("selected") ||
  document.getElementById("saiyan").classList.contains("selected") ||
  document.getElementById("bird").classList.contains("selected"))
{
  document.getElementById("file").disabled = false;
}
else
{
  document.getElementById("file").disabled = true;
}
}

function onOff()
{
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			var link = xhr.responseText;
			if (link == "error")
				return;
			if (link == "log")
			{
				window.location.href = "signin.php";
				return;
			}
			if (link == "off")
				document.getElementById("on_off").innerHTML = "OFF";
			else
				document.getElementById("on_off").innerHTML = "ON";
		}
	};
	xhr.open("POST", "notifications.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(null);
}

function uploaded(file)
{
	var formData = new FormData();
  if (file.files[0] == undefined)
    return;
	formData.append('file[]', file.files[0], file.files[0].name);
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			var link = xhr.responseText;
			if (link == "error")
				return;
			document.getElementById("studio_galery").innerHTML = link + document.getElementById("studio_galery").innerHTML;
		}
	};
	xhr.open("POST", "process_file.php", true);
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
	formData.append("tree", tree);
	formData.append("hat", hat);
	formData.append("saiyan", saiyan);
	formData.append("bird", bird)
	xhr.send(formData);
}

function loadImage()
{
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			var link = xhr.responseText;
			if (link == "error")
				return;
			document.getElementById("galery").innerHTML += link;
		}
	};
	xhr.open("POST", "load_pictures.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("limit=" + limit);
	limit += 5;
}
