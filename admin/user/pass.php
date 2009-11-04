<?
$access = "users,user-admin"; //make false if all access
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
		if(isset($_GET['id']) && is_numeric($_GET['id']))
		{
			if (isset($_GET['return']))
			{
				$error = "";
				if ($_GET['return'] == "pass_not_match")
				{
					$error = '<p class="error">De to passwords var ikke ens</p>';					
				}
			}
			echo '
						<h1>Nyt password</h1>
						'.$error.'
						<p>Skriv det nye password to gange for at aktivere det.</p>';
			echo '
						<form method="post" action="?domain=admin/user&script=save_pass&id='.$_GET['id'].'">';
			echo MakeForm("Password", "pass_one", "", "pw", false, "Password skal være minimum 6 karaktere");
			echo MakeForm("Gentag", "pass_two", "", "pw", false, "Du skal gentage passwordet");
			echo Makeform("", "submit", "Aktiver", "submit", "", "");
			echo '
						</form>';
		}
		else
		{
			header("location: ?domain=admin/user&return=missing_id");
		}
		echo '</div>';
	}
}
?>
