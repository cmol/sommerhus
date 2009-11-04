<?
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
		if($_POST['pass_old'] != "" && $_POST['pass_one'] != "" && $_POST['pass_two'] != "")
		{
			$pass_old = $_POST['pass_old'];
			$pass_one = $_POST['pass_one'];
			$pass_two = $_POST['pass_two'];
			$id = $_SESSION['user_id'];
			$md5_pass_old = md5($pass_old);
			if (strlen($pass_one) < 6)
			{
				header("location: ?domain=home&script=pass&return=pass_too_short");
			}
			elseif ($pass_one != $pass_two)
			{
				header("location: ?domain=home&script=pass&return=pass_dont_match");
			}
			else
			{
				$query = mysql_query("SELECT * FROM user WHERE id = '$id' AND password = '$md5_pass_old'") or die(mysql_error());
				$num = mysql_num_rows($query);
				if ($num == "1")
				{
					$md5pass = md5($pass_one);
					mysql_query("UPDATE user set password = '$md5pass' WHERE id = '$id' LIMIT 1") or die(mysql_error());
					header("location: ?domain=home&return=pass_update_ok");
				}
				else
				{
					header("location: ?domain=home&script=pass&return=old_pass_wrong");
				}
			}
		}
		else
		{
			header("location: ?domain=home&script=pass&return=passes_missing");
		}
	}
}
?>
