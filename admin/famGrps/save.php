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
		$color = $_POST['color'];
		$famName = $_POST['famName'];
		$color = clean($color);
		$famName = clean($famName);
		
		// Update existing group
		if (isset($_GET['id']))
		{
			$id = $_GET['id'];
			mysql_query("UPDATE familyGrps SET color = '$color', famName = '$famName' WHERE id = '$id' LIMIT 1") or die(mysql_error());
			header("location: ?domain=admin/famGrps&return=update_ok");
		}
		// Create new group
		else
		{
			mysql_query("INSERT INTO familyGrps (color, famName) VALUES ('$color', '$famName')") or die(mysql_error());
			header("location: ?domain=admin/famGrps&return=make_ok");
		}
	}
}
?>
