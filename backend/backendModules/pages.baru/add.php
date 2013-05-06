<?php
include "../../../adminAPI.php";

$newTimestamp = time();
$pageURL = strtoURL($_POST["title"]);
if(!$pageURL){
	$pageURL = "not-ready";
}

$pageAdd = new baruSQL("INSERT INTO `".$db_prefix."Pages` VALUES ('', '".$_POST["title"]."', '".htmlentities($_POST["inhalt"])."', '".$userinfo["ID"]."', '".$pageURL."', '".$_POST["blog"]."', '".$_POST["category"]."','".$newTimestamp."')");
if($pageAdd->execute()){
	echo "success";
} else {
	echo $pageAdd->sqlError();
}
?>