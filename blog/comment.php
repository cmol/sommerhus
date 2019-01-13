<?php
$access = "users"; //make false if all access
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
			
			$text = $_POST['text'];
			$text = clean($text);
			$date = time();										
			$blog_id = $_GET['blogid'];
			
			if($text == "")
			{
				header("location: ?domain=blog&script=blog&id=$blog_id&return=comment_blank#do_comment");
			}
			else
			{
				if (isset($_GET['blogid']) && is_numeric($_GET['blogid']))
				{
					$user_id = $_SESSION['user_id'];
				
					mysql_query("INSERT INTO blog_comment (author, text, date, belong_to) VALUES ('$user_id', '$text', '$date', '$blog_id')") or die(mysql_error());
					header("location: ?domain=blog&script=blog&id=$blog_id&return=comment_ok");
				}
				else
				{
					header("location: ?domain=blog&script=blog&id=$blog_id&return=ivalid_blog_id#do_comment");
				}
			}
		echo '
		</div>';
	}
}
?>
