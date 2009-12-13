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
		<div id="left">
			<h1>Bruger liste</h1>';
			if (isset($_GET['return']))
			{
				if ($_GET['return'] == "update_ok")
				{
					echo '<p class="ok">Brugeren blev opdateret</p>';
				}
				elseif ($_GET['return'] == "make_ok")
				{
					echo '<p class="ok">Brugeren blev oprettet</p>';
				}
				elseif ($_GET['return'] == "delete_ok")
				{
					echo '<p class="ok">Brugeren blev slettet</p>';
				}
				elseif ($_GET['return'] == "no_valid_user")
				{
					echo '<p class="alert">Brugeren findes ikke</p>';
				}
			}
			
			
			$query = mysql_query("SELECT user.id, name, email, tlf, address, groups, famName FROM user, familyGrps WHERE familyGrp = familyGrps.id ORDER BY name ASC") or die(mysql_error());
			while($row = mysql_fetch_assoc($query))
			{
				/*echo '<pre>';
				print_r($row);
				echo '</pre>';*/
				echo '
				<div class="user_list">
					<div class="user_info">
						<p>
						<b>Navn:</b><br>
						<b>Mail:</b><br>
						<b>Telefon:</b><br>
						<b>Addresse:</b><br>
						</p>
					</div>
					<div class="user_infos">
						<p>
						'.$row['name'].'<br>
						'.$row['email'].'<br>
						'.$row['tlf'].'<br>
						'.$row['address'].'
						</p>
					</div>
					<div class="user_edit">
						<img onmouseover="this.style.cursor=\'pointer\'" onclick="location.href=\'?domain=admin/user&script=edit&id='.$row['id'].'\'" src="img/pencil_small.png" alt="Rediger" title="Rediger">
						<img onmouseover="this.style.cursor=\'pointer\'" onclick="location.href=\'?domain=admin/user&script=pass&id='.$row['id'].'\'" src="img/shield_small.png" alt="Rediger password" title="Rediger password">
						<img onmouseover="this.style.cursor=\'pointer\'" onclick="disp_confirm(\'?domain=admin/user&script=delete&id='.$row['id'].'\',\'Vil du slette brugeren '.$row['name'].'\')" src="img/no_entry_small.png" alt="Slet" title="Slet">
					</div>
					<div class="user_groups">
					<p><b>Medlem af:</b> ';
					$grps = explode(",",$row['groups']);
					foreach($grps as $grp)
					{
						echo $grp . " ";
					}
				echo'</p>
					</div>
					<div class="famName">
						<p><b>Gruppe: </b>'.$row['famName'].'</p>
					</div>
				</div>';
			}
		echo '
		</div>';
	}
}
?>
