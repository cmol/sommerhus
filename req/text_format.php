<?php

function make_links($text)
{
	// This first part will add http:// where it is missing
	$offset = 0;
	$start_offset = 1;
	$test = true;
	while (strripos($text, "www.", $offset) && $start_offset != $offset)
	{
		$start_offset = $offset;
		$start = strripos($text, "www.", $offset);
		$end = strripos($text, " ", $start) - 1;
		if (substr($text, $start - 7, 7) != 'http://')
		{
			$text = substr_replace($text, "http://".substr($text, $start, $end), $start, $end);
		}
		$offset = $end;
	}
	
	// This part will find all the http:// and make links out of them
	return eregi_replace("([[:alnum:]]+)://([^[:space:]]*)([[:alnum:]#?/&=])","<a href=\"\\1://\\2\\3\" target=\"_blank\">\\1://\\2\\3</a>", $text);
}

function make_format($text)
{
	// This part will find standart bb code, and make html out of it
	$find = array("[b]", "[/b]", "[u]", "[/u]", "[i]", "[/i]", "[del]", "[/del]");
	$replace = array("<b>", "</b>", "<u>", "</u>", "<i>", "</i>", "<del>", "</del>");
	return str_replace($find, $replace, $text);
}

function format_text($text)
{
	// This part will mix those two together, and return it to the user.
	return make_format(make_links($text));
}

?>
