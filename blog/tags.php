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
			<h1>Tags</h1>';
			$tag_list = array();
			$query = mysqli_query($connection,"SELECT tags FROM blog_post") or die(mysqli_error());
			while($row = mysqli_fetch_assoc($query))
			{
				$tags = explode(" ", $row['tags']);
				foreach ($tags as $tag)
				{
					if (isset($tag_list[$tag]))
					{
						$tag_list[$tag]++;
					}
					else
					{
						$tag_list[$tag] = 1;
					}
				}
			}
			
			arsort($tag_list);
			
			echo '
			<table width="100%">';
			foreach($tag_list as $tag => $count)
			{
				echo '
				<tr><td><a href="?domain=blog&script=search&search_by=tag&tag='.$tag.'">'.$tag.' - '.$count.' steder</td></tr>';
			}
		echo '
			</table>
		</div>';
	}
}
?>
