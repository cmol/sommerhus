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
		if($_POST['pass_one'] != "" && $_POST['pass_two'] != "" && isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$pass_one = $_POST['pass_one'];
			$pass_two = $_POST['pass_two'];
			$id = $_GET['id'];
			if (strlen($pass_one) < 6)
			{
				header("location: ?domain=admin/user&script=pass&id=$id&return=pass_too_short");
			}
			elseif ($pass_one != $pass_two)
			{
				header("location: ?domain=admin/user&script=pass&id=$id&return=pass_dont_match");
			}
			else
			{
				$md5pass = md5($pass_one);
				mysql_query("UPDATE user set password = '$md5pass' WHERE id = '$id' LIMIT 1") or die(mysql_error());
				header("location: ?domain=admin/user&return=pass_update_ok");
			}
		}
	}
}
?>
