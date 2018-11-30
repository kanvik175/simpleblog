<?php

  include("includes/config.php");

  $pass = new Password();

  $pass_hash = $pass->password_hash("Vdo3#a9t", 1);

  echo $pass_hash;

?>
