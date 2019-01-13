<?php
if(isset($_GET['color']))
{
	$color = $_GET['color'];
}
else
{
	$color = "green";
}
echo'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Stripe test</title>
<link rel="StyleSheet" type="text/css" href="style-'.$color.'.css" />
</head>
<body>
<div class="stripe">
<img src="img/logo-'.$color.'-web20-2.png" class="logotext" alt="logo">
<img src="img/lensboel_logo_transparent_small.png" class="logo" alt="logo">
</div>
<center><div class="main">
<div class="container" align="left">
<h1>Lorem ipsum</h1>';
if(!isset($_GET['count']))
{
	$num = 1;
}
else
{
	$num = $_GET['count'];
}
for($x=1;$x<=$num;$x++)
{
echo '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam porttitor. Pellentesque eu leo luctus velit rhoncus placerat. Quisque rhoncus semper dui. Nulla facilisi. Fusce dapibus eros id odio. Integer eros erat, porttitor a, commodo sodales, sodales sed, ante. Donec ultricies dolor ut tellus. In hac habitasse platea dictumst. Pellentesque nisl turpis, aliquam non, commodo ut, lobortis in, enim. Donec purus nibh, imperdiet eu, dictum tristique, scelerisque quis, tellus.<br><br>
Aliquam neque. Morbi tempus egestas justo. Donec magna dolor, ultricies et, faucibus non, faucibus vel, nisl. Maecenas ultrices augue ut risus. Ut commodo. Praesent ac arcu. Aliquam erat volutpat. Nunc augue. Sed sed quam. Fusce tincidunt nulla non augue. Proin volutpat ipsum tincidunt dolor. Aenean odio. Morbi vitae nisi et tortor pulvinar auctor. Integer mattis magna et eros. Fusce pellentesque, erat vel suscipit scelerisque, leo lectus suscipit lacus, vitae sagittis ante elit vehicula diam. Donec commodo pulvinar mauris. Proin in erat. Nam tempus, purus sed consequat commodo, sem dolor condimentum felis, sed iaculis eros dui et mi.<br><br>
Donec sit amet eros. Morbi elementum lobortis purus. Mauris eu velit in libero porta lacinia. Integer diam neque, eleifend at, ultrices quis, pharetra vel, neque. In hac habitasse platea dictumst. Mauris vel libero ornare massa consequat vulputate. Donec lectus. Nunc ullamcorper eros eu urna. Mauris elit mauris, tempor et, gravida non, imperdiet ut, sem. Aenean magna. Fusce sed mauris ut mauris vehicula eleifend. Ut non libero vitae magna molestie hendrerit. Ut in nunc sed leo vulputate aliquam. Aenean fermentum. Proin eu mi at leo varius cursus. Aliquam nec turpis. Integer eros eros, vulputate et, dictum sed, semper non, massa.</p>';
}
echo '<p>&copy; Copyright Claus Lensb&oslash;l 2009</p>
</div>
<div class="rightbox" align="left">
<h2>Lorem ipsum</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam porttitor. Pellentesque eu leo luctus velit rhoncus placerat. Quisque rhoncus semper dui. Nulla facilisi. Fusce dapibus eros id odio. Integer eros erat, porttitor a, commodo sodales, sodales sed, ante. Donec ultricies dolor ut tellus. In hac habitasse platea dictumst. Pellentesque nisl turpis, aliquam non, commodo ut, lobortis in, enim. Donec purus nibh, imperdiet eu, dictum tristique, scelerisque quis, tellus.</p>
</div>
</div></center>
<div class="foot"> </div>
</body>
</html>';
?>
