<?php
$access = "users,administration,blog-admin"; //make false if all access
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
			if (isset($_GET['id']) && is_numeric($_GET['id']))
			{
				$id = $_GET['id'];
				mysql_query("DELETE FROM blog_post WHERE id = '$id' LIMIT 1") or die(mysql_error());
				mysql_query("DELETE FROM blog_comment WHERE belong_to = '$id'") or die(mysql_error());
				header("location: ?domain=admin/blog&return=blog_delete_ok");
			}
		echo'
		</div>';
	}
}
?>
