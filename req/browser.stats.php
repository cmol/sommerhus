<?php
$agent = clean($_SERVER['HTTP_USER_AGENT']);
$query = mysqli_query($connection,"SELECT * FROM browser_stat WHERE user_agent = '$agent'") or die(mysqli_error());
$num = mysqli_num_rows($query);
if($num < 1)
{
	mysqli_query($connection,"INSERT INTO browser_stat (user_agent, count) VALUES ('$agent', '1')") or die(mysqli_error());
}
else
{
	$row = mysqli_fetch_assoc($query);
	$count = $row['count'] + 1;
	echo $count;
	mysqli_query($connection,"UPDATE browser_stat SET count = '$count' WHERE user_agent = '$agent'") or die(mysqli_error());
}
?>
