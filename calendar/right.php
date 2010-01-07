<?
if(substr($_SERVER["SCRIPT_NAME"], -9, 9) != "index.php")
{
	echo '<p class="error">You cannot run this script directly!</p>';
}
else
{
	if($good)
	{
		echo '
		<div id="right">
			<h2>Menu</h2>
			
			<h2>Booking</h2>
		
			<form action="?domain=calendar&script=save" method="post">
			<input type="hidden" name="start" value="'.$start.'">
			<div id="booking">';
		
		if (isset($_GET['return']))
		{
			$gReturn['missing_dates'] = 			'<p class="alert">Du skal angive datoer</p>';
			$gReturn['make_ok'] = 						'<p class="ok">Booking succesfuld</p>';
			$gReturn['booking_overlap'] = 			'<p class="alert">Bookingen overlapper en anden booking</p>';
			$gReturn['dates_not_in_range'] = 	'<p class="alert">Datoerne er ikke valide</p>';
			
			echo $gReturn[$_GET['return']];
			
		}
		
		echo'	
				Start (DD/MM/YYYY): <input type="text" name="startDate"><br>
				Slut (DD/MM/YYYY): <input type="text" name="endDate"><br><br>
				Evt. kommentar:<br>
				<textarea name="comment"></textarea>
				<br><br>
				<input type="submit" value="Gem">
			</div>
			</form>
			
		</div>';
	}
}
?>
