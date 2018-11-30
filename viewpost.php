<?php

  require_once("includes/config.php");

  $stmt = $db->prepare("SELECT postID, postTitle, postCont FROM blog_posts WHERE postID = :postID");
  $stmt->execute(array(":postID"=>$_GET['id']));
  $row = $stmt->fetch();

  if($row['postID'] == "") {
    header("Location: ./");
    exit;
  }

  echo "<h1>".$row['postTitle']."</h1>";
  echo "<p>".$row['postCont']."</p>";

 ?>
