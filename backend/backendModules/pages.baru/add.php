<?php
include "../../../adminAPI.php";

$newTimestamp = time();
$pageURL = strtoURL($_POST["title"]);
if(!$pageURL){
	$pageURL = "not-ready";
}

mysql_query("INSERT INTO `".$db_prefix."Pages` VALUES ('', '".$_POST["title"]."', '".$_POST["inhalt"]."', '".$userinfo["ID"]."', '".$pageURL."', '".$_POST["blog"]."', '".$_POST["category"]."','".$newTimestamp."')", $mysql);

if(!mysql_error()){
	echo "success";
}
?>