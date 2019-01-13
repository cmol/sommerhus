<?php
$access = "users,blog-edit"; //make false if all access
if(substr($_SERVER["SCRIPT_NAME"], -9, 9) != "index.php")
{
	echo '<p class="error">You cannot run this script directly!</p>';
}
else
{
	require('req/test.login.php');
	if($good)
	{
		echo '
		<div id="left">';
			
			$title = $_POST['title'];
			$text = $_POST['text'];
			$tags = $_POST['tags'];
						
			$title = clean($title);
			$text = clean($text);
			$tags = clean($tags);
			$date = time();										

			# Update
			if (isset($_GET['id']))
			{
				$id = $_GET['id'];
				mysqli_query($connection,"UPDATE blog_post SET title = '$title', text = '$text', tags = '$tags', last_edit = '$date' WHERE id = '$id' LIMIT 1") or die(mysqli_error());
				header("location: ?domain=blog&script=blog&id=$id&return=update_ok");
			}
			# Make
			else
			{
				$author = $_SESSION['user_id'];
				mysqli_query($connection,"INSERT INTO blog_post (title, text, tags, author, date) VALUES ('$title', '$text', '$tags', '$author', '$date')") or die(mysqli_error());
				header("location: ?domain=blog&return=make_ok");
				
			}
			
		echo '
		</div>';
	}
}
?>
