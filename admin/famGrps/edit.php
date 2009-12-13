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
		echo '
		<div id="left">';
		
		if (isset($_GET['id']))
		{
			echo '
			<h1>Rediger gruppe</h1>';
			$id = $_GET['id'];
			$query = mysql_query("SELECT id, famName, color FROM familyGrps WHERE id = '$id' LIMIT 1") or die(mysql_error());
			
			$row = mysql_fetch_assoc($query);
			echo '
			<form method="post" action="?domain=admin/famGrps&script=save&id='.$id.'">';
			echo MakeForm("Navn", "famName", $row['famName'], "tf", true, "Du skal angive et navn");
			echo MakeForm("Farve #", "color", $row['color'], "tf", true, "Du skal angive en farve");
			echo Makeform("", "submit", "Gem", "submit", "", "");
			echo '
			</form>';
		}
		else
		{
			echo '
			<h1>Opret gruppe</h1>';
			echo '
			<form method="post" action="?domain=admin/famGrps&script=save">';
			echo MakeForm("Navn", "famName", "", "tf", true, "Du skal angive et navn");
			echo MakeForm("Farve #", "color", "", "tf", true, "Du skal angive en farve");
			echo Makeform("", "submit", "Opret", "submit", "", "");
			echo '
			</form>';
		}
		
		echo '
		</div>';
	}
}
?>
