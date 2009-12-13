<?
$access = "users,blog-edit"; //make false if all access
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
		$id = 0;
		if(is_numeric($_GET['id']))
		{
			echo '<h1>Rediger blog</h1>';
			$id = $_GET['id'];
			$query = mysql_query("SELECT * FROM blog_post WHERE id = '$id' LIMIT 1") or die(mysql_error());
			$row = mysql_fetch_assoc($query);
			if($row['author'] == $_SESSION['user_id'] || strstr($_SESSION['groups'], "blog-admin"))
			{
				echo '<form method="post" action="?domain=blog&script=save&id='.$id.'">';
				echo MakeForm("Titel", "title", $row['title'], "tf", true, "Du skal skrive en titel");
				echo MakeForm("Tekst", "text", $row['text'], "ta", true, "Du skal skrive noget indhold", "large");
				echo '<p>[b]<b>fed</b>[/b] - [u]<u>understreget</u>[/u] - [i]<i>kursiv</i>[/i] - [del]<del>gennemstreget</del>[/del]</p>';
				echo MakeForm("Tags", "tags", $row['tags'], "tf", true, "Du skal skrive nogen tags (fx. stue male omm&oslash;blering)");
				echo Makeform("", "submit", "Gem", "submit", "", "");
				echo "</form>";
			}
			elseif ($row['author'] != $_SESSION['user_id'] && !strstr($_SESSION['groups'], "blog-admin"))
			{
				header("location: ?domain=blog&return=blog_edit_not_owner");
			}
		}
		else
		{
			echo '<h1>Skriv blog</h1>';
			$id = $_GET['id'];
			echo '<form method="post" action="?domain=blog&script=save">';
			echo MakeForm("Titel", "title", "", "tf", true, "Du skal skrive en titel");
			echo MakeForm("Tekst", "text", "OM SKIVNING AF BLOGS:\nS&oslash;rg for at l&aelig;se dine blogs igennem f&oslash;r du opretter dem!!!\n\nLav gerne en 'teaser', og skriv '##DEL##' efter din teaser. S&aring; vil teaseren blive vist på forsiden, og resten n&aring;r man klikker sig ind p&aring; bloggen.\n\nDu kan bruge nedenst&aring;ende til formatering.", "ta", true, "Du skal skrive noget indhold", "large");
			echo '<p>[b]<b>fed</b>[/b] - [u]<u>understreget</u>[/u] - [i]<i>kursiv</i>[/i] - [del]<del>gennemstreget</del>[/del]</p>';
			echo MakeForm("Tags", "tags", "", "tf", true, "Du skal skrive nogen tags (fx. stue male omm&oslash;blering)");
			echo Makeform("", "submit", "Opret", "submit", "", "");
			echo "</form>";
		}
		echo'	
		</div>';
	}
}
?>
