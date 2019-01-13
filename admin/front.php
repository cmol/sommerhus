<?php
$access = "users,administration"; //make false if all access
if(substr($_SERVER["SCRIPT_NAME"], -9, 9) != "index.php")
{
	echo '<p class="error">You cannot run this script directly!</p>';
}
else
{
	require('req/test.login.php');
	if($good)
	{
		echo '
		<div id="left">
			<img id="page_img_r" src="img/parcel.png" alt="Administration">
			<h1>Administration</h1>
			<p class="ok">Yeah baby! Yeah....</p>
		</div>';
	}
}
?>
