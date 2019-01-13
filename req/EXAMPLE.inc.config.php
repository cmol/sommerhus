<?php
$connection = mysqli_connect("SERVER","USERNAME","PASSWORD"); 
mysqli_select_db($connection, "DATABASE") or die(mysqli_error());
$db_prefix = "";
?>
