  <div class="leftwindow">
    <div class="panel">
    <a class="panel" href="./change_Username.php">Change Username</a><br/>
    <a class="panel" href="./change_Password.php">Change Password</a><br/>
    <a class="panel" href="./change_Email.php">Change E-mail</a><br/>
    <a class="panel" href="./notif.php">Notifications</a><br/>
    <a class="panel" href="./change_param.php">Parameters</a><br/>
    <a class="panel" href="./contact_Us.php">Contact US</a><br/>
  </div>
  </div>
  <div class="rightwindow">
    <a class="panel">Filtre1</a><br/>
    <a class="panel">Filtre2</a><br/>
    <a class="panel">Filtre3</a><br/>
    <a class="panel">Filtre4</a><br/>
    <a class="panel">Filtre5</a><br/>
  </div>
<div class="box_big_message">
  <div class="description">
    Here you can take pictures of yourself and add some cool filters to it!
    </br>
    </br>
    Enjoy!
    </br>  </br>  </br>  </br>
  </div>
  <div class="photobooth"><video id="video"></video></div>
  <canvas style="display: none;" id="canvas"></canvas>
  <div class="photobooth"><img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
  </br>
  <button id="startbutton">Prendre une photo</button></div>
  <script>
  (function() {

    var streaming = false,
        video        = document.querySelector('#video'),
        cover        = document.querySelector('#cover'),
        canvas       = document.querySelector('#canvas'),
        photo        = document.querySelector('#photo'),
        startbutton  = document.querySelector('#startbutton'),
        width = 320,
        height = 0;

    video.addEventListener('canplay', function(ev){
      if (!streaming) {
        height = video.videoHeight / (video.videoWidth/width);
        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);
        streaming = true;
      }
    }, false);

    var constraints = {video:true};
    navigator.getUserMedia = navigator.getUserMedia ||
                navigator.webkitGetUserMedia ||
                navigator.mozGetUserMedia;
    if (navigator.getUserMedia)
      navigator.getUserMedia(constraints, success, failure);

    function takepicture() {
      canvas.width = width;
      canvas.height = height;
      canvas.getContext('2d').drawImage(video, 0, 0, width, height);
      var data = canvas.toDataURL('image/png');
      photo.setAttribute('src', data);
    }
    function failure(error)
    {
      alert(error);
    }

    function success(stream)
    {
      var video = document.querySelector('#video');
      if (video.mozSrcObject !== undefined)
        video.mozSrcObject = stream;
      else if (video.srcObject !== undefined)
        video.srcObject = stream;
      else
        video.src = stream;
      video.play();
    }

        startbutton.addEventListener('click', function(ev){
            takepicture();
          ev.preventDefault();
        }, false);

      })();
      </script>
    </div>
</div>
