<?php
function get_by_id($do, $id)
{
	switch ($do)
	{
		case 'name':
			$gbid_query = mysqli_query($connection,"SELECT id, name FROM user where id = '$id' LIMIT 1");
			$row = mysqli_fetch_assoc($gbid_query);
			return $row['name'];
		break;
		
		case 'number_blog_comments':
			$gbid_query = mysqli_query($connection,"SELECT id FROM blog_comment WHERE belong_to = '$id'");
			$gbid_num = mysqli_num_rows($gbid_query);
			return $gbid_num;
		break;
		
		case 'userGroup':
			$gbid_query = mysqli_query($connection,"SELECT familyGrp FROM user WHERE id = '$id'");
			$row = mysqli_fetch_assoc($gbid_query);
			return $row['familyGrp'];
		break;
				
		default:
			# code...
		break;
	}
}
?>
