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
		echo '<div id="left"><form name="login" action="?script=do&domain=login" method="post">
		<h1>login</h1>';
		if(isset($_GET['error']))
		{
			if($_GET['error'] == "wrong")
			{
				echo '<p class="alert">Forkert email eller password</p>';
			}
			elseif($_GET['error'] == "missing")
			{
				echo '<p class="alert">Du skal angive email og password</p>';
			}
		}
		echo '<p>email: <input class="login" type="text" name="email"></p>
		<p>password: <input class="login" type="password" name="pass"><br>';
		echo '<input type="submit" class="button" value="login"></p>';
		echo '</form></div><div id="right"></div>
		';
	}
}
?>
