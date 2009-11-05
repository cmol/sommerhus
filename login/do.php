<?
$access = false; //make false if all access
if(substr($_SERVER["SCRIPT_NAME"], -9, 9) != "index.php")
{
	echo '<p class="error">You cannot run this script directly!</p>';
}
else
{
	require('req/test.login.php');
	if($good)
	{
		if($_POST['email'] != "" && $_POST['pass'] != "")
		{
			$email = clean($_POST['email']);
			$pass = $_POST['pass'];
			$md5pass = md5($pass);
			$query = mysql_query("SELECT * FROM ".$db_prefix."user where email = '$email' AND password = '$md5pass' LIMIT 1") or die(mysql_error());
		 	$num = mysql_num_rows($query);
			if($num == 1)
			{
				while ($row = mysql_fetch_assoc($query))
				{
					$_SESSION['checksum'] = md5($row['id'].$row['groups'].session_id());
					$_SESSION['user_id'] = $row['id'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['groups'] = $row['groups'];
					$_SESSION['id'] = session_id();
				}
				$time = time();
				$uid = $row['id'];
				mysql_query("UPDATE ".$db_prefix."user SET last_online = '$time' WHERE id = '$uid'") or die(mysql_error());
				header("location: ?");
				echo session_id();
			}
			else
			{
				header("location: ?script=login&domain=login&error=wrong");
			}
		}
		else
		{
			header("location: ?script=login&domain=login&error=missing");
		}

	}
}
?>
