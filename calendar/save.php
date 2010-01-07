<?
$access = "users,calendar-edit"; //make false if all access
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
		
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$comment = $_POST['comment'];
		$comment = clean($comment);
		$start = $_POST['start'];
		$sDateE = explode("/", $startDate);
		$eDateE = explode("/", $endDate);
		
		
		// Calculate $start parameter
		if(isset($_POST['start']))
		{
			$start = $_POST['start'];
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
		
		if(($_POST['startDate'] != "" && $_POST['endDate'] != "") && is_numeric($sDateE['0']) && is_numeric($sDateE['1']) && is_numeric($sDateE['2']) && is_numeric($eDateE['0']) && is_numeric($eDateE['1']) && is_numeric($eDateE['2']))
		{

			$startDate = mktime(6, 0, 0, $sDateE['1'], $sDateE['0'], $sDateE['2']);
			$endDate = mktime(14, 0, 0, $eDateE['1'], $eDateE['0'], $eDateE['2']);
			
			$query = mysql_query("SELECT id FROM calendar_bookings WHERE (startDate <= '$startDate' OR startDate <= '$endDate') AND (endDate >= '$startDate' OR endDate >= '$endDate')") or die(mysql_error());
			if(mysql_num_rows($query) > 0)
			{
				header("location: ?domain=calendar&return=booking_overlap&start=$start");
			}
			else
			{
				if($startDate > time() + 60*60*24*365 || $endDate > time() + 60*60*24*365 || $startDate < time() - 60*60*24*30 || $endDate < time() - 60*60*24*30) // Do not allow bookings older than one month, and newer than one year
				{
					header("location: ?domain=calendar&return=dates_not_in_range&start=$start");
				}
				else
				{
					$userId = $_SESSION['user_id'];
					$bookingFamily = get_by_id("userGroup", $userId);
					$now = time();
					
					mysql_query("INSERT INTO calendar_bookings (startDate, endDate, bookingFamily, bookingTime, bookingUser, comment) VALUES ('$startDate', '$endDate', '$bookingFamily', '$now', '$userId', '$comment')") or die(mysql_error());
					header("location: ?domain=calendar&return=make_ok&start=$start");
				}
			}
		}
		else
		{
			header("location: ?domain=calendar&return=missing_dates&start=$start");
		}
		
		
		
		echo '
		</div>';
	}
}
?>
