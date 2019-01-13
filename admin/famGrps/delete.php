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
		if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] != "1");
		{
			$id = $_GET['id'];
			mysqli_query($connection,"DELETE FROM familyGrps WHERE id = '$id' LIMIT 1") or die(mysqli_error());
			
			mysqli_query($connection,"UPDATE user SET familyGrp = '1' WHERE familyGrp = '$id'") or die(mysqli_error());
			header("location: ?domain=admin/famGrps");
		}
		elseif($_GET['id'] == "1")
		{
			header("location: ?domain=admin/famGrps&return=cannot_delete_native_group");
		}
	}
}
?>
