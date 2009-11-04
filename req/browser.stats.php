<?php
$agent = clean($_SERVER['HTTP_USER_AGENT']);
$query = mysql_query("SELECT * FROM browser_stat WHERE user_agent = '$agent'") or die(mysql_error());
$num = mysql_num_rows($query);
if($num < 1)
{
	mysql_query("INSERT INTO browser_stat (user_agent, count) VALUES ('$agent', '1')") or die(mysql_error());
}
else
{
	$row = mysql_fetch_assoc($query);
	$count = $row['count'] + 1;
	echo $count;
	mysql_query("UPDATE browser_stat SET count = '$count' WHERE user_agent = '$agent'") or die(mysql_error());
}
?>
