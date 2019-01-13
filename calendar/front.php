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
		echo '
		<div id="left">';
		
		if (isset($_GET['return']))
		{
			$gReturn["delete_ok"] = '<p class="ok">Bookingen blev slettet</p>';
			
			echo $gReturn[$_GET['return']];
		}
		
		
		// Calculate when to start
		if(isset($_GET['start']))
		{
			$start = $_GET['start'];
		}
		else
		{
			if(date("n") > 3 && date('n') < 10)
			{
				$start = date('Y')."-s";
			}
			elseif(date("n") < 3)
			{
				$start = date('Y')-1 ."-w";
			}
			elseif(date("n") > 3)
			{
				$start = date('Y')."-w";
			}
		}
		
		$expl = explode("-", $start);
		$mo = ($expl[1] == "s") ? 4 : 10;
		$day = mktime(12, 0, 0, $mo, 1, $expl[0]);
		$end = $day + 185 * 60 * 60 * 24;
		$week = null;
		
		
		// Make previous and forward buttons
		if ($expl[1] == "s")
		{
			$prev = $expl[0] - 1 ."-w";
			$next = $expl[0]."-w";
		}
		else
		{
			$prev = $expl[0]."-s";
			$next = $expl[0] + 1 ."-s";
		}
		
		echo '
			<div id="prevNext">
				<a href="?domain=calendar&start='.$prev.'">Forrige halv&aring;r</a> | 
				<a href="?domain=calendar&start='.$next.'">N&aelig;ste halv&aring;r</a>
			</div><br>';
		
		// Get data for this period and store it in an array (theres no need make 180 some mysql calls for showing his calendar!!!)
		
		$query = mysqli_query($connection, "SELECT calendar_bookings.id, startDate, endDate, color, comment, famName FROM calendar_bookings, familyGrps WHERE bookingFamily = familyGrps.id AND (endDate > '$day' AND startDate < '$end')") or die(mysqli_error());
		for($y = 0; $row = mysqli_fetch_assoc($query); $y++)
		{
			$calData[$y]['id'] = $row['id'];
			$calData[$y]['startDate'] = $row['startDate'];
			$calData[$y]['endDate'] = $row['endDate'];
			$calData[$y]['famName'] = $row['famName'];
			$calData[$y]['color'] = $row['color'];
			$calData[$y]['comment'] = $row['comment'];
		}
		
		// For month translation to Danish
		$month_da["January"] = "Januar";
		$month_da["February"] = "Februar";
		$month_da["March"] = "Marts";
		$month_da["April"] = "Apris";
		$month_da["May"] = "Maj";
		$month_da["June"] = "Juni";
		$month_da["July"] = "Juli";
		$month_da["August"] = "August";
		$month_da["September"] = "September";
		$month_da["October"] = "Oktober";
		$month_da["November"] = "November";
		$month_da["December"] = "December";

		
		// Draw calendar		
				
		for ($i = 0; $i < 6; $i++)
		{
			// Start month
			echo '
			<div class="month_container">
				<div class="month_name">'.$month_da[date("F", $day)].' '.date("y", $day).'</div><br>';
			$month = date("m", $day);
	
			while (date("j", $day) <= date("t", $day) && $month == date("m", $day))
			{
				// Print the day (Here goes all the stuff with day number, type, week number, coler for booking.... Yada yada)
				$day_class = "cal_day";
				if (date("N", $day) == 1)
				{
					$day_class = "cal_day_monday";
				}
				elseif (date("N", $day) == 6 || date("N", $day) == 7)
				{
					$day_class = "cal_day_weekend";
				}
				
				echo '
				<span class="'.$day_class.'"><div class="day">'.date("j", $day).'</div>';
				
				// Content colering and so goes here
				//
				
				for($y = 0; $y < count($calData); $y++)
				{
					if($calData[$y]['startDate'] < $day && $calData[$y]['endDate'] > $day )
					{
						echo '<div onclick="location.href=\'?domain=calendar&script=show&id='.$calData[$y]['id'].'\'" class="booking" style="background-color: #'.$calData[$y]['color'].'" title="'.$calData[$y]['famName'].' | '.$calData[$y]['comment'].'">|</div>';
					}
				}
						
				//
				// Content END
				
				echo
				'
				</span>';
		
				// Printing week number if it's monday
				if (date("N", $day) == 1)
				{
					echo '<span class="cal_week">'." uge ".date("W", $day).'</span>';
				}
				// Week number END
		
				// Print day end
				if (date("j", $day) != date("t", $day))
				{
					echo '
					<br>';
				}
				$day = $day + 60*60*24;
				$week = date("W", $day);
			}		
	
			// End month

			echo '
			</div>';
		}
		
		echo '
		</div>';
	}
}
?>
