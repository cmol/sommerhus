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
		<div id="left">
			<h1>Booking</h1>';
		if (isset($_GET['id']) && is_numeric($_GET['id'])) // Test for valid input
		{
			$id = $_GET['id'];
			$query = mysql_query("SELECT calendar_bookings.id, startDate, endDate, color, comment, famName, name, bookingTime, bookingFamily FROM calendar_bookings, familyGrps, user WHERE bookingFamily = familyGrps.id AND calendar_bookings.id = '$id' AND bookingUser = user.id LIMIT 1") or die(mysql_error());
			if (mysql_num_rows($query) > 0) // Test if record with that ID exists
			{
				$row = mysql_fetch_assoc($query);
			
				echo'
			<h2>Fra '.get_date($row['startDate'], "simple").' til '.get_date($row['endDate'], "simple").'</h2>
			<p class="author">Booket af <a href="?domain=user&script=show&id='.$row['bookingUser'].'">'.$row['name'].'</a> '.get_date($row['bookingTime']).'</p>
			<p><b>Kommentar:</b> '.$row['comment'].'</p><br>';
				
				if(($_SESSION['familyGrp'] == $row['bookingFamily'] || strpos($_SESSION['groups'], "calendar-admin")) && strpos($_SESSION['groups'], "calendar-edit")) // Test if the user should se editing tools. They will be shown to bookingFamily, AND calendar-admin
				{
					echo '
			<h2>Ret</h2>
			<form action="?domain=calendar&script=edit" method="post">
			<input type="hidden" name="id" value="'.$id.'">
			<div id="booking">';
		
					if (isset($_GET['return'])) // Look for error codes, and display.
					{
						$gReturn['missing_dates'] = 			'<p class="alert">Du skal angive datoer</p>';
						$gReturn['make_ok'] = 						'<p class="ok">Booking succesfuld</p>';
						$gReturn['booking_overlap'] = 		'<p class="alert">Bookingen overlapper en anden booking</p>';
						$gReturn['dates_not_in_range'] = 	'<p class="alert">Datoerne er ikke valide</p>';
						
						echo '<div id="largeEdit">'.$gReturn[$_GET['return']].'</div>';
					}
		
					echo'	
				Start (DD/MM/YYYY): <input type="text" name="startDate" value="'.date("d/m/Y", $row['startDate']).'"><br>
				Slut (DD/MM/YYYY): <input type="text" name="endDate" value="'.date("d/m/Y", $row['endDate']).'"><br><br>
				Evt. kommentar:<br>
				<textarea name="comment">'.$row['comment'].'</textarea>
				<br><br>
				<input type="submit" value="Opdater">
			</div>
			</form>
			
			<br><h2>Slet</h2>
			<div onmouseover="this.style.cursor=\'pointer\'" onclick="disp_confirm(\'?domain=calendar&script=delete&id='.$row['id'].'\',\'Vil du slette denne booking?\')" alt="Slet" title="Slet">
				<img src="img/no_entry_small.png"> Klik her for at slette denne booking
			</div>';
				}
				
			}
			else
			{
				echo '<p class="alert">Kunne ikke finde den angivne booking</p>';
			}
		}
		else
		{
			echo '<p class="alert">Kunne ikke finde den angivne booking</p>';
		}
		echo'
		</div>';
	}
}
?>
