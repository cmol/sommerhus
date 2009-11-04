<?php
function clean($txt)
{
	$txt = htmlspecialchars($txt, ENT_QUOTES);
	$find		= array("æ", "ø", "å", "Æ", "Ø", "Å", "\&quot;", "\&#039;");
	$replace	= array("&aelig;", "&oslash;", "&aring;", "&AElig;", "&Oslash;", "&Aring;", "&quot;", "&#039;");
	$txt = str_replace($find, $replace, $txt);
	$txt = mysql_real_escape_string($txt);
	return $txt;
}
?>
