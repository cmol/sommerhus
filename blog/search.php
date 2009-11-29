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
		<div id="left">
			<h1>S&oslash;gning</h1>';
			if(isset($_GET['search_by']))
			{
				switch ($_GET['search_by'])
				{
					case 'tag':
						$tag = $_GET['tag'];
						$query_string = "SELECT * FROM blog_post WHERE tags LIKE '%$tag%' ORDER BY date DESC";
					break;
					
					case 'content':
						$title = $_GET['title'];
						$text = $_GET['text'];
						$query_string = "SELECT * FROM blog_post WHERE title LIKE '%$title%' OR text LIKE '%$text%' ORDER BY date DESC";
					break;
					
					default:
						$query_string = "SELECT * FROM blog_post ORDER BY date DESC";
					break;
				}
				$query = mysql_query($query_string) or die(mysql_error());
				echo '
			<table width="100%">';
				while($row = mysql_fetch_assoc($query))
				{
					echo '
				<tr><td><a href="?domain=blog&script=blog&id='.$row['id'].'">'.$row['title'].'</a> - '.get_date($row['last_edit']).' - '.CutAfterX(un_format_text($row['text']), 70).'... </td></tr>';
				}
			}
		echo '
			</table>
		</div>';
	}
}
?>
