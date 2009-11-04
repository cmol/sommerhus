<?php
$colors["green"] = "#51773D";
$colors["black"] = "#777";
$colors["blue"] = "#465288";
$colors["blue-2"] = "#465288";
$colors["brown"] = "#876626";
$colors["red"] = "#885b5b";
$colors["yellow"] = "#6b4a12";
$iecolor = $colors[$color];


if(isset($_SESSION['checksum']))
{

	$menu = array(
		"Forside"					=>	"?",
		"Blog"						=>	"?domain=blog",
		"Kalender"				=>	"#",
		"Administration"	=>	"?domain=admin"
	);
	if(!strstr($_SESSION['groups'], "administration"))
	{
		unset($menu["Administration"]);
	}
}
else
{
	$menu = array("Log in" => "?domain=login&script=login");
}


echo '<ul id="topmenu">';
if(stristr($_SERVER['HTTP_USER_AGENT'], "msie"))
{
	foreach($menu as $text => $link)
	{
		echo'
		<li class="menulink" onclick="location.href=\''.$link.'\'" onmouseover="this.style.backgroundImage=\'url(img/trans_menu_hover.png)\'; this.style.color=\'#fff\'; this.style.cursor=\'pointer\'" onmouseout="this.style.backgroundImage=\'url(img/trans_menu_nohover.png)\'; this.style.color=\''.$iecolor.'\';">'.$text.'</li>';
	}
}
else
{
	foreach($menu as $text => $link)
	{
		echo'
		<li class="menulink" onclick="location.href=\''.$link.'\'">'.$text.'</li>';
	}
}
echo '</ul>';
?>
