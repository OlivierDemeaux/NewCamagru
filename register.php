<?php include_once('connection.php'); ?>
<?php include('./header.php'); ?></br></br></br>
<?php

  if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password_conf'])
    && isset($_POST['email']) && $_POST['login'] != "" && $_POST['password'] != "" && $_POST['password_conf'] != "" && $_POST['email'] != "")
  {
    if ($_POST['password'] != $_POST['password_conf'])
        echo "The two passwords don't match";
    else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        echo "Your email is not valide";
    else if (strlen($_POST['password']) < 8)
        echo "The password must be a least 8 characters";
    else if (!preg_match("#[0-9]+#", $_POST['password']))
        echo "Password must include at least a number";
    else if (!preg_match("#[a-zA-Z]+#", $_POST['password']))
        echo "Password must include at least a letter";
    else
    {
          $req = $bdd->prepare('SELECT id FROM users WHERE login = ?');
    		  $req->execute(array($_POST["login"]));
    		  $reqb = $bdd->prepare('SELECT id FROM users WHERE email = ?');
    		  $reqb->execute(array($_POST["email"]));
          if ($req->rowCount() > 0)
    			     echo "login is already used";
    		  else if ($reqb->rowCount() > 0)
    			     echo "Email is already used";
          else
          {
              $hash = hash('whirlpool', $_POST['password']);
              $req = $bdd->prepare('INSERT INTO users (login, password, email, confirmed, notification) VALUES (:login, :password, :email, 0, 1)');
              $req->execute(array(
              'login' => $_POST['login'],
              'password' => $hash,
              'email' => $_POST['email']
              ));
              $req = $bdd->prepare('SELECT id FROM users WHERE login = ?');
        			$req->execute(array($_POST["login"]));
        			$data = $req->fetch();
        			$msg = 'To validate your account please click on the following link : http://localhost:8080/confirmation.php?r='.$data['id'];
        			mail($_POST['email'], 'Account confirmation', $msg);
        			echo "Congratulation, your account has been created. We sent you an email with details. You will have to activate your account by clicking the link in the email.";
        			exit;
          }
      }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
    <link rel="stylesheet" type="text/css" href="camagru.css">
  </head>
  <body>
    <div class="login_box">
      <form action="register.php" method="post">
    			<input class="login" type="email" name="email" placeholder="Email" required />
    			<br />
    			<input class="login" type="text" name="login" placeholder="Login" required />
    			<br />
    			<input class="login" type="password" name="password" placeholder="Password" required />
    			<br />
    			<input class="login" type="password" name="password_conf" placeholder="Confirmation" required />
    			<br />
    			<br />
    			<input class="submit" type="submit" value="Register" />
		  </form>
    </div>
  </body>
</html>
<?php include_once('footer.php') ?>
