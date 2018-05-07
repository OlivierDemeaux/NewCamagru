<div class="body">
      <video id="video"></video>
      <canvas style="display: none;" id="canvas"></canvas>
      <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
      </br>
      <button id="startbutton">Prendre une photo</button>
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
