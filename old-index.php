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
<link rel="StyleSheet" type="text/css" href="style/style-'.$color.'.css"></head>
<body>

<div id="wrap">

	<div id="main">
		<div id="header">
			<div id="lensboel-dk"> </div>
			<div id="logo"> </div>
			<ul id="topmenu">
			';
			require_once("req/menu.php");	
			echo'</ul>
		</div>
		<div id="content">
			<div id="left">
			<h1>Lorem ipsum</h1>';
			
if(isset($_GET['count']))
{
	$count = $_GET['count'];
}
else
{
	$count = 1;
}

for($x = 1; $x<=$count; $x++)
{			
			echo'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam porttitor. Pellentesque eu leo luctus velit rhoncus placerat. Quisque rhoncus semper dui. Nulla facilisi. Fusce dapibus eros id odio. Integer eros erat, porttitor a, commodo sodales, sodales sed, ante. Donec ultricies dolor ut tellus. In hac habitasse platea dictumst. Pellentesque nisl turpis, aliquam non, commodo ut, lobortis in, enim. Donec purus nibh, imperdiet eu, dictum tristique, scelerisque quis, tellus.</p><p>
Aliquam neque. Morbi tempus egestas justo. Donec magna dolor, ultricies et, faucibus non, faucibus vel, nisl. Maecenas ultrices augue ut risus. Ut commodo. Praesent ac arcu. Aliquam erat volutpat. Nunc augue. Sed sed quam. Fusce tincidunt nulla non augue. Proin volutpat ipsum tincidunt dolor. Aenean odio. Morbi vitae nisi et tortor pulvinar auctor. Integer mattis magna et eros. Fusce pellentesque, erat vel suscipit scelerisque, leo lectus suscipit lacus, vitae sagittis ante elit vehicula diam. Donec commodo pulvinar mauris. Proin in erat. Nam tempus, purus sed consequat commodo, sem dolor condimentum felis, sed iaculis eros dui et mi.</p><p>
Donec sit amet eros. Morbi elementum lobortis purus. Mauris eu velit in libero porta lacinia. Integer diam neque, eleifend at, ultrices quis, pharetra vel, neque. In hac habitasse platea dictumst. Mauris vel libero ornare massa consequat vulputate. Donec lectus. Nunc ullamcorper eros eu urna. Mauris elit mauris, tempor et, gravida non, imperdiet ut, sem. Aenean magna. Fusce sed mauris ut mauris vehicula eleifend. Ut non libero vitae magna molestie hendrerit. Ut in nunc sed leo vulputate aliquam. Aenean fermentum. Proin eu mi at leo varius cursus. Aliquam nec turpis. Integer eros eros, vulputate et, dictum sed, semper non, massa.</p>';
}
echo '<br>';
$sep = "";
foreach($colors as $color => $hex)
			{
				echo $sep.'
				<h3 style="color: '.$hex.'; float: left" class="menulink" onclick="location.href=\'?color='.$color.'\'" onmouseover="this.style.color=\'#fff\'; this.style.cursor=\'pointer\'" onmouseout="this.style.color=\''.$hex.'\';">'.$color.'</h3>';
				$sep = '<h3 style="float: left"> - </h3>';
			}
echo'			</div>
			<div id="right">
			<h2>Lorem ipsum</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam porttitor. Pellentesque eu leo luctus velit rhoncus placerat. Quisque rhoncus semper dui. Nulla facilisi. Fusce dapibus eros id odio. Integer eros erat, porttitor a, commodo sodales, sodales sed, ante. Donec ultricies dolor ut tellus. In hac habitasse platea dictumst. Pellentesque nisl turpis, aliquam non, commodo ut, lobortis in, enim. Donec purus nibh, imperdiet eu, dictum tristique, scelerisque quis, tellus.</p>
			<p>&copy; Copyright Claus Lensb&oslash;l '.date("Y").'</p>
			</div>
		</div>
	</div>
</div>
<div id="footer">
</div>
</body>
</html>';
