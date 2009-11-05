<?php
$connection = mysql_connect("SERVER","USERNAME","PASSWORD"); 
mysql_select_db("DATABASE", $connection) or die(mysql_error());
$db_prefix = "";
?>
