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
			<h2>Right!</h2>
			<pre>';
			print_r($_SESSION);
			echo $_SESSION['name'];
			echo'</pre>
		</div>';
	}
}
?>
