<?php

  require_once("../includes/config.php");

  if(!$user->is_logged_in()) {
    header("Location: login.php");
    exit;
  }

  include("menu.php");

  if(isset($_POST['submit'])) {

    if($_POST['postTitle'] == "") {
      $error[] = "There are no title!";
    }

    if($_POST['postDesc'] == "") {
      $error[] = "There are no description!";
    }

    if($_POST['postCont'] == "") {
      $error[] = "There are no content!";
    }

    if(!isset($error)) {
      try {
        $stmt = $db->prepare("INSERT INTO blog_posts (postTitle, postDesc, postCont, postDate) VALUES (:postTitle, :postDesc, :postCont, NOW())");

        $stmt->execute(array(":postTitle"=>$_POST['postTitle'], ":postDesc"=>$_POST['postDesc'], ":postCont"=>$_POST['postCont']));
      } catch(PDOException $e) {
        echo $e->getMessage();
      }

      echo $_POST['postTitle']." ".$_POST['postTitle']." ".$_POST['postCont'];
    } else {
      foreach($error as $error) {
        echo $error." ";
      }
    }


  }

?>

<form action="" method="POST">
  <label>Post title</label><input type="text" name="postTitle" value=""><br><br>
  <label>Post Description</label><input type="text" name="postDesc"  value=""><br><br>
  <label>Post Content</label><input type="text" name="postCont"  value=""><br><br>
  <input type="hidden" name = "postDate" value = "<?php  ?>">
  <input type="submit" name="submit" value="submit">
</form>
