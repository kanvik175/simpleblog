<?php

	//comment first comment

	require_once('includes/config.php');

	try {
		$stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC');
		while($row = $stmt->fetch()) {
			echo '<h1><a href="viewpost.php?id='.$row['postID'].'">'.$row['postTitle'].'</a></h1>';
			echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
			echo '<p>'.$row['postDesc'].'</p>';
			echo '<a href = "viewpost.php?id='.$row['postID'].'">Read more</a><br><hr><br>';
			}
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
