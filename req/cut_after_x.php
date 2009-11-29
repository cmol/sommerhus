<?php

// This is a function to cut string after x minus the distance to closest " " "," "." ":" ";" "-" "?" "1"

function CutAfterX($string, $x)
{
	while (1)
	{
		$cut = substr($string, $x, 1);
		if($cut == " " || $cut == "," || $cut == "." || $cut == ":" || $cut == ";" || $cut == "-" || $cut == "?" || $cut == "!")
		{
			return substr($string, 0, $x+1);
			break;
		}
		$x--;
	}
}

?>
