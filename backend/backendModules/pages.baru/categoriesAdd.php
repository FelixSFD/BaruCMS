<?php
include "../../../adminAPI.php";

mysql_query("INSERT INTO `".$db_prefix."Categories` VALUES ('', '".$_POST["name"]."', '".strtoURL($_POST["name"])."', 'hidden')", $mysql);

if(!mysql_error()){
	echo "success";
}
?>