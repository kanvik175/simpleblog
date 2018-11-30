opt<?php

  include("../includes/config.php");

  if(!$user->is_logged_in()) {
    header("Location: login.php");
  }

  require_once("menu.php");

  if(isset($_GET["id"]) && !isset($_POST['submit'])) {
    try {
      $stmt = $db->prepare("SELECT postTitle, postDesc, postCont FROM blog_posts WHERE postID = :id");
      $stmt->execute(array(":id"=>$_GET["id"]));
      $row = $stmt->fetch();
        ?>

        <form action="" method="POST">
          <label>Post title</label><input type="text" name="postTitle" value="<?php echo $row["postTitle"] ?>"><br><br>
          <label>Post Description</label><input type="text" name="postDesc"  value="<?php echo $row["postDesc"] ?>"><br><br>
          <label>Post Content</label><input type="text" name="postCont"  value="<?php echo $row["postCont"] ?>"><br><br>
          <input type="hidden" name="postID" value="<?php echo $_GET['id'] ?>">
          <input type="submit" name="submit" value="submit">
        </form>

        <?php

    } catch (PDOException $e) {
    echo $e->getMessage();
  }
}

  if(isset($_POST['submit'])) {

    echo $_POST["postTitle"];
    echo $_POST["postDesc"];
    echo $_POST["postCont"];
    echo $_POST["postID"];

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

        $stmt = $db->prepare("UPDATE blog_posts SET postTitle = :postTitle,
          postDesc = :postDesc, postCont = :postCont WHERE postID = :postID");

        $stmt->execute(array(
          ":postTitle"=>$_POST["postTitle"],
          ":postDesc"=>$_POST["postDesc"],
          ":postCont"=>$_POST["postCont"],
          ":postID"=>$_POST["postID"]
        ));

        header("Location: index.php?action=update");
        exit;

      } catch (PDOException $e) {
        echo $e->getMessage();
      }

    }



  }

 ?>
