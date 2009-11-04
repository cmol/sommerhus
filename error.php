<?
$access = false; //make false if all access
if(substr($_SERVER["SCRIPT_NAME"], -9, 9) != "index.php")
{
	echo '<p class="error">You cannot run this script directly!</p>';
}
else
{
	require('req/test.login.php');
	if($good)
	{
		$error = array (
		"404"	=>	"Siden findes ikke",
		"403-1"	=>	"Du skal v&aelig;re logget ind for at se denne side",
		"403-2"	=>	"Du har ikke rettigheder til at se denne side",
		"403-3" =>	"KRITISK: Fejl i checksum"
		);
		echo '
		<div id="left">
			<img src="img/intruder.png" id="page_img_l" alt="Error...">
			<h2>Oops.. '.$error[$_GET['error']].'</h2>
			<p><b>domain: </b>'.$_GET['reqdomain'].'</p>
			<p><b>script: </b>'.$_GET['reqscript'].'</p>
		</div>';
	}
}
?>
