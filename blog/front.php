<?
$access = "users"; //make false if all access
if(substr($_SERVER["SCRIPT_NAME"], -9, 9) != "index.php")
{
	echo '<p class="alert">You cannot run this script directly!</p>';
}
else
{
	require('req/test.login.php');
	if($good)
	{
		echo '
		<div id="left">';
		// how many rows to show per page
		$rowsPerPage = 5;
		// by default we show first page
		$pageNum = 1;
		// if $_GET['page'] defined, use it as page number
		if(isset($_GET['page']))
		{
			$pageNum = $_GET['page'];
		}
		// counting the offset
		$offset = ($pageNum - 1) * $rowsPerPage;
		$query = mysql_query("SELECT * FROM blog_post ORDER BY date desc LIMIT $offset, $rowsPerPage") or die(mysql_error());
		while ($row = mysql_fetch_assoc($query))
		{
			echo '
			<div class="blog_container">
				<a class="title" href="?domain=blog&script=blog&id='.$row['id'].'">'.$row['title'].'</a>
				<p class="author">Skrevet af: <a href="?domain=user&script=show&id='.$row['author'].'">'.get_by_id("name", $row['author']).'</a> '.get_date($row['date']).'';
				if($row['last_edit'] != 0) echo ' - Sidst redigeret '.get_date($row['last_edit']);
				if($row['author'] == $_SESSION['user_id']) echo ' - <a href="?domain=blog&script=edit&id='.$row['id'].'">Rediger</a>';
				echo '</p>';
				$formText = format_text(str_replace("<br />", "<br>", nl2br($row['text'])));
				
				if(strpos($formText, "##DEL##"))
				{
					$pos = strpos($formText, "##DEL##");
					$formText = substr($formText, 0, $pos);
				}
				echo'
				<p>'.$formText.'</p>
				<p class="tags"><i>Tags: </i>';
				$tags = explode(" ", $row['tags']);
				foreach($tags as $tag)
				{
					echo '<a href="?domain=blog&script=search&search_by=tag&tag='.$tag.'">'.$tag.'</a> ';
				}
				echo'
				</p>';
				if(get_by_id("number_blog_comments", $row['id']) > 0)
				{
					echo '
				<p><i>'.get_by_id("number_blog_comments", $row['id']).' kommentarer</i></p>';
				}
				else
				{
					echo '
				<p><i>Ingen kommentarer</i></p>';
				}
				echo '
			</div>';
		}
				
		// Making navigation for previous and next
		$query = mysql_query("SELECT * FROM blog_post") or die(mysql_error());
		$blog_total = mysql_num_rows($query);
		
		echo '
		<div id="prev_next">';
		if ($pageNum > 1)
		{
			echo '
			<div class="left"><a href="?domain=blog&page='.($pageNum - 1).'">Nyere blogs</a></div>';
		}
		if ($blog_total > ($pageNum * $rowsPerPage))
		{
			echo '
			<div class="right"><a href="?domain=blog&page='.($pageNum + 1).'">&AElig;ldre blogs</a></div>';
		}
		echo '
		</div>';
		// Making navigation for previous and next end
		
		echo
		'</div>';
	}
}
?>
