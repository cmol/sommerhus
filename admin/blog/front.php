<?
$access = "users,administration,blog-admin"; //make false if all access
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
		echo '
			<h1>Blog Administration</h1>';
			
		if (isset($_GET['return']))
		{
			if ($_GET['return'] == "blog_delete_ok")
			{
				echo '
			<p class="ok">Bloggen dens kommentarer blev slettet!</p>';
			}
		}
			
		// how many rows to show per page
		$rowsPerPage = 50;
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
		echo '
			<table>';
		while ($row = mysql_fetch_assoc($query))
		{
			echo '
				<tr><td>
					<p><a href="?domain=blog&script=blog&id='.$row['id'].'">'.$row['title'].'</a>
					 - <a href="?domain=user&script=show&id='.$row['author'].'">'.get_by_id("name", $row['author']).'</a> ';
				if($row['last_edit'] != 0)
				{
					echo ' - Sidst redigeret '.get_date($row['last_edit']);
				}
				else
				{
					echo ' - Sidst redigeret '.get_date($row['date']);
				}
				echo ' - '.get_by_id("number_blog_comments", $row['id']). ' kommentare';
				echo '
					<img onmouseover="this.style.cursor=\'pointer\'" onclick="location.href=\'?domain=blog&script=edit&id='.$row['id'].'\'" src="img/pencil_small.png" alt="Rediger" title="Rediger">
					<img onmouseover="this.style.cursor=\'pointer\'" onclick="disp_confirm(\'?domain=admin/blog&script=delete&id='.$row['id'].'\',\'Vil du slette bloggen '.$row['title'].',\nog alle dens kommentarer?\')" src="img/no_entry_small.png" alt="Slet" title="Slet">';
				echo '
					</p>
				</td></tr>';
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
		
		echo'
		</div>';
	}
}
?>
