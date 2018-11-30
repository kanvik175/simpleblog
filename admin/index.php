<?php

  require_once("../includes/config.php");

  if(!$user->is_logged_in()){ header('Location: login.php'); }

  if(isset($_GET['delpost'])) {
    $stmt = $db->prepare("DELETE FROM blog_posts WHERE postID = :postID");
    $stmt->execute(array(":postID"=>$_GET['delpost']));
    header("Location: index.php?action=deleted");
    exit;
  }

  include("menu.php");

  if(isset($_GET['action'])) {
    echo "<h3>". $_GET['action']."</h3>";
  }

 ?>

 <table>
   <tr>
    <th>Title</th>
    <th>Date</th>
    <th>Action</th>
   </tr>

   <?php

      try {
        $stmt = $db->query("SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID DESC");
        while($row = $stmt->fetch()) {
            ?>

            <tr>
              <td><?php echo $row['postTitle'] ?></td>
              <td><?php echo date('jS M Y', strtotime($row['postDate'])) ?></td>
              <td>
                <a href="edit-post.php?id=<?php echo $row['postID'] ?>">Edit post</a>
                <a href="index.php?delpost=<?php echo $row['postID'] ?>">Delete post</a>
              </td>
            </tr>

            <?php
        }
      } catch(PDOException $e) {
        echo "<p>".$e->getMessage()."</p>";
      }

    ?>




</table>
