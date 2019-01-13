<?php
$access = "users,user-admin"; //make false if all access
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
				# Delete user
				$id = $_GET['id'];
				mysqli_query($connection,"DELETE FROM user WHERE id = '$id' LIMIT 1") or die(mysqli_error());
				header("location: ?domain=admin/user&return=delete_ok");
			}
			else
			{
				# return error
				header("location: ?domain=admin/user&return=no_valid_user");
			}
		echo '
		</div>';
	}
}
?>
