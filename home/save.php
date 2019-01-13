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
		<div id="left">';
			
			$name = $_POST['name'];
			$email = $_POST['email'];
			$tlf = $_POST['tlf'];
			$address = $_POST['address'];
			
			$name = clean($name);
			$email = clean($email);
			$tlf = clean($tlf);
			$address = clean($address);
			
			# Update
			if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] == $_SESSION['user_id'])
			{
				$id = $_GET['id'];
								
				mysqli_query($connection,"UPDATE user set name = '$name', email = '$email', tlf = '$tlf', address = '$address' WHERE id = '$id' LIMIT 1") or die(mysqli_error());
				header("location: ?domain=home&return=update_ok");
			}
			else
			{
				header("location: ?domain=home&script=edit&return=update_id_error");
			}

			
		echo '
		</div>';
	}
}
?>
