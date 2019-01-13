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
			<h1>Familie grupper</h1>';
		
		if (isset($_GET['return']))
		{
			switch ($_GET['return'])
			{
				case 'update_ok':
					echo '<p class="ok">Gruppen blev opdateret</p>';
				break;
				
				case 'make_ok':
					echo '<p class="ok">Gruppen blev oprettet</p>';
				break;
				
				case 'cannot_delete_native_group':
					echo '<p class="alert">Kan ikke slette system grupper</p>';
				break;
				
				default:
					// nothing here.........
				break;
			}
		}
		
		
		$query = mysql_query("SELECT name, user.id AS uid, familyGrps.id, famName, color FROM user, familyGrps WHERE familyGrp = familyGrps.id ORDER BY famName") or die(mysql_error());
		$currentFamily = null;
		while($row = mysql_fetch_assoc($query))
		{
			if ($row['famName'] == $currentFamily)
			{
				echo '
					<br><a href="?domain=user&script=show&id='.$row['uid'].'">'.$row['name'].'</a>';
			}
			else
			{
				if ($currentFamily != null)
				{
					echo '
				</p>';
				}
				echo '
				<br>
				<h2>'.$row['famName'].'</h2>
				<p>
					<img onmouseover="this.style.cursor=\'pointer\'" onclick="location.href=\'?domain=admin/famGrps&script=edit&id='.$row['id'].'\'" src="img/pencil_small.png" alt="Rediger" title="Rediger">
					<img onmouseover="this.style.cursor=\'pointer\'" onclick="disp_confirm(\'?domain=admin/famGrps&script=delete&id='.$row['id'].'\',\'Vil du slette gruppen '.$row['famName'].'\')" src="img/no_entry_small.png" alt="Slet" title="Slet"><br>
					<b>Farve: </b> <span class="colorShow" style="background-color: #'.$row['color'].'">#'.$row['color'].'</span><br>
					<b>Medlemmer:</b>
					<br><a href="?domain=user&script=show&id='.$row['uid'].'">'.$row['name'].'</a>';
				$currentFamily = $row['famName'];
			}
		}
		
		echo'
		</div>';
	}
}
?>
