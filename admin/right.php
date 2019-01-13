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
			<a href="?domain=admin/user">Bruger Admin</a><br>
			<a href="?domain=admin/famGrps">Gruppe Admin</a><br>
			<a href="?domain=admin/blog">Blog Admin</a>
		</div>';
	}
}
?>
