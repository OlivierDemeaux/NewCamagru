<?php include_once('connection.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
    <script scr="camagruJS.js"></script>
    <link rel="stylesheet" type="text/css" href="./camagru.css">
  </head>
  <body>
  <?php include_once('header.php'); ?>
</br></br>
<div class="box_big_message"> Welcome on our website!<br/>
  Here you can take funny pictures and share them to our community!<br/>
  You only have to register to get started!<br/>
  Here are the pictures of our community! Join us ! <br/><br/><br/><br/>
  <div class="photo">
  <?php $req = $bdd->prepare('SELECT * FROM images ORDER BY creation DESC');
        $req->execute(array());
        while ($el = $req->fetch())
        {
          $reqb = $bdd->prepare('SELECT id FROM likes WHERE image = ?');
			    $reqb->execute(array($el['id']));
			    $likes = $reqb->rowCount();
          $reqb = $bdd->prepare('SELECT id FROM likes WHERE image = ? AND creator = ?');
			    $reqb->execute(array($el['id'], $_SESSION['id']));
			    $me = $reqb->rowCount();
          $src = "images/like.svg";
          if ($me == 1)
				      $src = "images/liked.svg";
          ?>
				      <img class="gallery" src="pictures/<?php echo $el['id'] ?>.png">
				      <div class="interaction">
                  <img onclick="likeImage(<?php echo $el['id'] ?>);" id="like<?php echo $el['id'] ?>" class="likes" src="<?php echo $src ?>">
                  <span id="nbr_likes<?php echo $el['id'] ?>" class="likes"><?php echo $likes ?></span>
                </div></br>
              <?php
        }
         ?>
       </div>
     </div>
  </body>
</html>
<?php include_once('footer.php') ?>
