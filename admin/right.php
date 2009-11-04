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
			<h2>:: menu ::</h2>
			<a href="?domain=admin/user">Bruger Admin</a>
		</div>';
	}
}
?>
