<?php
include "../../../adminAPI.php";
mysql_query("DELETE FROM `".$db_prefix."Groups` WHERE ID = ".$_POST["id"], $mysql);
if(!mysql_error()){
	echo "success";
}
?>