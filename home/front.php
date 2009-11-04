<?
$access = "users"; //make false if all access
if(substr($_SERVER["SCRIPT_NAME"], -9, 9) != "index.php")
{
	echo '<p class="error">You cannot run this script directly!</p>';
}
else
{
	require('req/test.login.php');
	if($good)
	{
		if (isset($_GET['return']))
		{
			if ($_GET['return'] == "update_ok")
			{
				$return = '<p class="ok">Dine brugeroplysninger blev opdateret</p>';
			}
			elseif ($_GET['return'] == "pass_update_ok")
			{
				$return = '<p class="ok">Dit password blev opdateret</p>';
			}
		}
		
		echo '
		<div id="left">
			<h1>Min bruger</h1>
			'.$return.'
			<p>Her kan du se og redigere dine data.<br>
			Med tiden vil her komme mere information om hvad du har lavet her p&aring; siden, samt mulighed for at følge med i de ting du er involveret i.</p>
			<p>Brug menuen i h&oslash;jre side for at se og redigere dine data.</p>
		</div>';
	}
}
?>
