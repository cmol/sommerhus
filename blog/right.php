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
			<a href="?domain=blog&script=edit">Tilf&oslash;j blog</a><br>
			<a href="?domain=blog&script=list">Vis liste over blogs</a><br>
			<input type="text" name="search"><input type="submit" value="S&oslash;g">
		</div>';
	}
}
?>
