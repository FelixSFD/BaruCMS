<?php
include "../../../adminAPI.php";

mysql_query("INSERT INTO `".$db_prefix."Groups` VALUES ('', '".$_POST["name"]."')", $mysql);

if(!mysql_error()){
	echo "success";
}
?>