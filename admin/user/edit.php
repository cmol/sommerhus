<?php
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
		echo '
		<div id="left">
			<img id="page_img_r" src="img/user.png" alt="user">';
		$id = 0;
		if(is_numeric($_GET['id']))
		{
			echo '<h1>Rediger bruger</h1>';
			$id = $_GET['id'];
			$query = mysql_query("SELECT * FROM user WHERE id = '$id' LIMIT 1") or die(mysql_error());
			$row = mysql_fetch_assoc($query);
			echo '<form method="post" action="?domain=admin/user&script=save&id='.$id.'">';
			echo MakeForm("Navn", "name", $row['name'], "tf", true, "Du skal angive et navn");
			echo MakeForm("Email", "email", $row['email'], "tf", true, "Du skal angive en email");
			echo MakeForm("Telefon", "tlf", $row['tlf'], "tf", true, "Du skal angive et telefonnummer");
			echo MakeForm("Addresse", "address", $row['address'], "tf", true, "Du skal angive en addresse");
			echo MakeForm("Medlem af", "groups", $row['groups'], "ta", true, "Du skal angive medlemskaber (rettighedder)");
			
			$familyGrp = $row['familyGrp'];
			echo '
			<p class="user_data"><span class="user_data">Gruppe: </span><select name="familyGrp">';
			$query = mysql_query("SELECT famName, id FROM familyGrps ORDER BY id") or die(mysql_error());
			while ($row = mysql_fetch_assoc($query))
			{
				echo '
				<option value="'.$row['id'].'"';
				if($familyGrp == $row['id']) echo ' selected="selected"';
				echo '>'.$row['famName'].'</option>'; 
			}
			echo "
			</select></p>";
					
			echo Makeform("", "submit", "Gem", "submit", "", "");
			echo "</form>";
		}
		else
		{
			echo '<h1>Tilføj bruger</h1>';
			echo '<form method="post" action="?domain=admin/user&script=save">';
			echo MakeForm("Navn", "name", "", "tf", true, "Du skal angive et navn");
			echo MakeForm("Email", "email", "", "tf", true, "Du skal angive en email");
			echo MakeForm("Password", "password", "", "tf", true, "Du skal angive et password");
			echo MakeForm("Telefon", "tlf", "", "tf", true, "Du skal angive et telefonnummer");
			echo MakeForm("Addresse", "address", "", "tf", true, "Du skal angive en addresse");
			echo MakeForm("Medlem af", "groups", "", "ta", true, "Du skal angive medlemskaber (rettighedder)");
			
			echo '
			<p class="user_data"><span class="user_data">Gruppe: </span><select name="familyGrp">';
			$query = mysql_query("SELECT famName, id FROM familyGrps ORDER BY id") or die(mysql_error());
			while ($row = mysql_fetch_assoc($query))
			{
				echo '
				<option value="'.$row['id'].'">'.$row['famName'].'</option>'; 
			}
			echo "
			</select></p>";
			
			echo Makeform("", "submit", "Opret", "submit", "", "");
			echo "</form>";
		}
		echo'	
		</div>';
	}
}
?>
