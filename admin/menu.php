<h1>Blog</h1>
<?php if(isset($_SESSION['username'])) { ?>
<p>Logged in as <?php $_SESSION['username'] ?></p>
<?php } ?>
<ul>
  <li><a href = "index.php">Posts</a></li>
  <li><a href = "users.php">Users</a></li>
  <li><a href = "../">View website</a></li>
  <li><a href = "add-post.php">Add post</a></li>
  <li><a href = "logout.php">Logout</a></li>
</ul>
<hr>
