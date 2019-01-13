<?php
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
			<a href="?domain=home">Min bruger</a><br>
			<a href="?domain=home&script=edit">Rediger mine data</a><br>
			<a href="?domain=home&script=pass">&AElig;ndre password</a><br>
		</div>';
	}
}
?>
