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
		<div id="left">';
			
			if(isset($_GET['id']) && is_numeric($_GET['id']))
			{
				$id = $_GET['id'];
				$query = mysql_query("SELECT * FROM blog_post where id = '$id'") or die(mysql_error());
				$row = mysql_fetch_assoc($query);
				
				echo '
			<div class="blog_container">
				<h1>'.$row['title'].'</h1>
				<p class="author">Skrevet af: <a href="?domain=user&script=show&id='.$row['author'].'">'.get_by_id("name", $row['author']).'</a> '.get_date($row['date']).'';
				if($row['last_edit'] != 0) echo ' - Sidst redigeret '.get_date($row['last_edit']);
				if($row['author'] == $_SESSION['user_id']) echo ' - <a href="?domain=blog&script=edit&id='.$row['id'].'">Rediger</a>';
				echo '</p>
				<p>'.format_text(str_replace("<br />", "<br>", nl2br($row['text']))).'</p>
				<p class="tags"><i>Tags: </i>';
				$tags = explode(" ", $row['tags']);
				foreach($tags as $tag)
				{
					echo '<a href="?domain=blog&script=search&search_by=tag&tag='.$tag.'">'.$tag.'</a> ';
				}
				echo'
				</p>
			</div>';
				
				echo '
			<h2>Kommentarer</h2>';
				
				$query = mysql_query("SELECT * FROM blog_comment where belong_to = '$id' ORDER BY date ASC") or die(mysql_error());
				$num = mysql_num_rows($query);
				if($num < 1)
				{
					echo '<p><i>Der er endnu ikke nogen kommentarer</i></p>';
				}
				
				while($row = mysql_fetch_assoc($query))
				{
					echo '
			<div class="blog_comment">';
					echo '
				<p class="author"><a href="?domain=user&script=show&id='.$row['author'].'">'.get_by_id("name", $row['author']).'</a> skrev '.get_date($row['date']).'</p>
				<p>'.format_text(str_replace("<br />", "<br>", nl2br($row['text']))).'</p>';
					echo '
			</div>';
				}
			
				$return = "";
				if (isset($_GET['return']))
				{
					if ($_GET['return'] == "comment_blank")
					{
						$return = '<p class="alert">Du skal skrive en kommentar</p>';
					}
					elseif ($_GET['return'] == "invalid_blog_id")
					{
						$return = '<p class="alert">Kunne ikke knytte kommentar til denne blog</p>';						
					}
					elseif ($_GET['return'] == "comment_ok")
					{
						$return = '<p class="ok">Kommentar gemt</p>';						
					}
				}
				
				echo '
			<div id="do_comment">
				<a name="do_comment">
				'.$return.'
				<form action="?domain=blog&script=comment&blogid='.$id.'" method="post">
				<p>Kommentar:<br>
				<textarea name="text"></textarea></p>
				<p class="right"><input type="submit" value="Opret"></p>												
				<p>[b]<b>fed</b>[/b] - [u]<u>understreget</u>[/u] - [i]<i>kursiv</i>[/i] - [del]<del>gennemstreget</del>[/del]</p>
				<p>BEM&AElig;RK: Du kan ikke rette i dine kommentarer</p>
				</form>
			</div>';
			}
			
		echo '
		</div>';
	}
}
?>
