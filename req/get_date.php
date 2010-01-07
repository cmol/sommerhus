<?php
function get_date($time, $type = "normal"){

$d = date("j", $time);
$m = date("n", $time);
$y = date("Y", $time);

$dnow = date("j");
$mnow = date("n");
$ynow = date("Y");

$find = array('May', 'Oct');
$replace = array('Maj', 'Okt');

if ($type == "normal") // Show normal date form (with "today" and "tomorrow")
{
	if ($y == $ynow && $m == $mnow)
	{
		if($d == $dnow)
		{
			$print = 'I dag kl. ';
			$print .= date("G:i", $time);
		}
		elseif($d == $dnow - 1)
		{
			$print = 'I g&aring;r kl. ';
			$print .= date("G:i", $time);
		}
		else
		{
		
			$print = str_replace($find, $replace, date('\d. j M Y', $time));
		}
	}
	else
	{
		$print = str_replace($find, $replace, date('\d. j M Y', $time));
	}
	return $print;		
}
else // return simple date form (without the today thing)
{
	return str_replace($find, $replace, date('\d. j M Y', $time));
}

?>
