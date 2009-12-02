<?php
if(isset($_GET['color']))
{
	$color = $_GET['color'];
}
else
{
	$color = "green";
}
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>lensboel.dk</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="StyleSheet" type="text/css" href="style-'.$color.'.css">
	<script src="req/valid.js" type="text/javascript" language="javascript" charset="utf-8"></script>
	<script type="text/javascript">
	function disp_confirm(site,text)
	{
		var conf=confirm(text)
		if (conf==true)
		{
			document.location.href=site
		}
	}
	</script>
</head>
<body>

<div id="wrap">

	<div id="main">
		<div id="header">
			<div id="lensboel-dk"> </div>
			<div id="logo"> </div>';
			if (isset($_SESSION['user_id']))
			{
				echo '
			<div id="my_user">
				<a href="?domain=home">Min bruger</a> | <a href="?domain=login&script=logout">Log ud</a>
			</div>';
			}
		echo'
		</div>
		<div id="content">
';
?>
