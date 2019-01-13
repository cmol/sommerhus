<?php
$access = "users,administration,blog-edit"; //make false if all access
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
		if(isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$id = $_GET['id'];
			$blog_id = $_GET['blog_id'];
			mysql_query("DELETE FROM blog_comment WHERE id = '$id' LIMIT 1") or die(mysql_error());
			header("location: ?domain=blog&script=blog&id=$blog_id&return=comment_delete_ok#do_comment");
		}
		echo'
		</div>';
	}
}
?>
