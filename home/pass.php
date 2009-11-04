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
		echo '<div id="left">';
		if (isset($_GET['return']))
		{
			$error = "";
			if ($_GET['return'] == "pass_not_match")
			{
				$error = '<p class="alert">De to passwords var ikke ens</p>';					
			}
			elseif ($_GET['return'] == "old_pass_wrong")
			{
				$error = '<p class="alert">Det gamle password var forkert</p>';
			}
			elseif ($_GET['return'] == "passes_missing")
			{
				$error = '<p class="alert">Du skal angive passwords i alle tre felter</p>';
			}
			elseif ($_GET['return'] == "pass_too_short")
			{
				$error = '<p class="alert">Dit password skal mindst være 6 karaktere langt</p>';
			}
		}
		echo '
					<h1>Nyt password</h1>
					'.$error.'
					<p>Skriv dit gamle password og derefter det nye password to gange for at aktivere det.</p>';
		echo '
					<form method="post" action="?domain=home&script=save_pass">';
		echo MakeForm("Gammelt Password", "pass_old", "", "pw", false, "");
		echo MakeForm("Nyt Password", "pass_one", "", "pw", false, "");
		echo MakeForm("Gentag nyt Password", "pass_two", "", "pw", false, "");
		echo Makeform("", "submit", "Aktiver nyt password", "submit", "", "");
		echo '
					</form>';
	
		echo '</div>';
	}
}
?>
