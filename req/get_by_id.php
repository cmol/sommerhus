<?php
function get_by_id($do, $id)
{
	switch ($do)
	{
		case 'name':
			$gbid_query = mysql_query("SELECT id, name FROM user where id = '$id' LIMIT 1");
			$row = mysql_fetch_assoc($gbid_query);
			return $row['name'];
		break;
		
		case 'number_blog_comments':
			$gbid_query = mysql_query("SELECT id FROM blog_comment WHERE belong_to = '$id'");
			$gbid_num = mysql_num_rows($gbid_query);
			return $gbid_num;
		break;
				
		default:
			# code...
		break;
	}
}
?>
