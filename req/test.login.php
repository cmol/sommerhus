<?php
// This script will test if the user is logged in,
// and if the user has the rights needed.

// By Claus Lensbøl @ 21/2-2009
// cmol [a-t] cmol.dk

if($access != false)
{
	if(isset($_SESSION['checksum']))
	{
		$page_groups = explode(",", $access);
		$goon = true;
		for($x = 0; $x < count($page_groups); $x++)
		{
			if(!strstr($_SESSION['groups'], $page_groups[$x]))
			{
				$x = 1000000000;
				$goon = false;
			}
		}
		if($goon)
		{
			if(md5($_SESSION['user_id'].$_SESSION['groups'].session_id()) == $_SESSION['checksum'])
			{
				$good = true;
				echo '<!--access granted-->';
				$id = $_SESSION['user_id'];
				$query = mysqli_query($connection, "SELECT * FROM ".$db_prefix."user where id = '$id' LIMIT 1") or die(mysqli_error());
				while ($row = mysqli_fetch_assoc($query))
				{
					$user['id'] = $row['id'];
					$user['name'] = $row['name'];
					$user['email'] = $row['email'];
				}
			}
			else
			{
				header("location: ?script=error&error=403-3&calcmd5=".md5($_SESSION['user_id'].$_SESSION['groups'].session_id()));
				echo '<p class="error">You do not have access to this page.</p>';
				echo '<a href="javascript:historygo(-1)">Go Back</a>';
				$good = 0;
				echo '<!--access not granted-->
';
				//User kicked
				echo md5($_SESSION['user_id'].$access.session_id()).'<br>';
				echo '
'.$_SESSION['checksum'];
			}
		}
		else
		{
			header("location: ?script=error&error=403-2");
			echo '<p class="error">You do not have access to this page.</p>';
			echo '<a href="javascript:historygo(-1)">Go Back</a>';
			$good = 0;
			echo '<!--access not granted-->';
			//User kicked
		}
	}
	else
	{
	header("location: ?script=error&error=403-1");
	echo '<p class="error">You do not have access to this page.</p>';
	echo '<a href="javascript:historygo(-1)">Go Back</a>';
	$good = 0;
	echo '<!--access not granted-->';
	//User kicked
	}
}
else
{
	$good = 1;
	echo '<!--access granted-->';
}
require("req/menu.php");
?>
