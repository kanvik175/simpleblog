<?php

  require_once("../includes/config.php");

  if($user->is_logged_in()) {
    header("Location: ./");
  }

  if(isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if($user->login($username, $password)) {
      header("Location: ./");
      exit;
    } else {
      $message = "<p>Username or password are incorrect</p>";
    }
  }

  if(isset($message)) { echo $message; };

 ?>

<form action="" method="POST">
  <p><label>Username</label><input type="text" name="username" value="" /></p>
  <p><label>Password</label><input type="password" name="password" value="" /></p>
  <p><input type="submit" name="submit" value="Login" /></p>
</form>
