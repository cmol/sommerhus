<?php
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
		<div id="left">
			<img id="page_img_r" src="img/user.png" alt="user">';

		echo '<h1>Rediger dine data</h1>';
		$id = $_SESSION['user_id'];
		$query = mysqli_query($connection,"SELECT * FROM user WHERE id = '$id' LIMIT 1") or die(mysqli_error());
		$row = mysqli_fetch_assoc($query);
		echo '<form method="post" action="?domain=home&script=save&id='.$id.'">';
		echo MakeForm("Navn", "name", $row['name'], "tf", true, "Du skal angive et navn");
		echo MakeForm("Email", "email", $row['email'], "tf", true, "Du skal angive en email");
		echo MakeForm("Telefon", "tlf", $row['tlf'], "tf", true, "Du skal angive et telefonnummer");
		echo MakeForm("Addresse", "address", $row['address'], "tf", true, "Du skal angive en addresse");
		echo Makeform("", "submit", "Gem", "submit", "", "");
		echo "</form>";
		echo'	
		</div>';
	}
}
?>
