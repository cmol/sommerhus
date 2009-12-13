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
		echo '
		<div id="left">';
			
			$name = $_POST['name'];
			$email = $_POST['email'];
			$tlf = $_POST['tlf'];
			$address = $_POST['address'];
			$groups = $_POST['groups'];
			$familyGrp = $_POST['familyGrp'];
			
			$name = clean($name);
			$email = clean($email);
			$tlf = clean($tlf);
			$address = clean($address);
			$groups = clean($groups);
			$familyGrp = clean($familyGrp);
			
			
			# Update
			if (isset($_GET['id']))
			{
				$id = $_GET['id'];
								
				mysql_query("UPDATE user set name = '$name', email = '$email', tlf = '$tlf', address = '$address', groups = '$groups', familyGrp = '$familyGrp' WHERE id = '$id' LIMIT 1") or die(mysql_error());
				header("location: ?domain=admin/user&return=update_ok");
			}
			else
			{
				# Make
				$password = $_GET['password'];
				$password = md5($password);
				
				mysql_query("INSERT INTO user (name, email, tlf, address, groups, familyGrp, password) VALUES ('$name', '$email', '$tlf', '$address', '$groups', '$familyGrp', '$password')") or die(mysql_error());
				header("location: ?domain=admin/user&return=make_ok");
				
			}
			
		echo '
		</div>';
	}
}
?>
