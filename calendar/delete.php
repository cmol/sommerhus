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
		echo '
		<div id="left">';
		
		if (isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$id = $_GET['id'];
			$query = mysql_query("SELECT bookingFamily FROM calendar_bookings WHERE id = '$id'") or die(mysql_error());
			$row = mysql_fetch_assoc($query);
			if ($_SESSION['familyGrp'] == $row['bookingFamily'] || strpos($_SESSION['groups'], "calendar-admin"))
			{
				mysql_query("DELETE FROM calendar_bookings WHERE id = '$id' LIMIT 1") or die(mysql_error());
				header("location: ?domain=calendar&return=delete_ok");
			}
		}
		else
		{
			echo '<p class="alert">Fejl i booking nummer<br>error: id not valid</p>';
		}
		
		echo '
		</div>';
	}
}
?>
