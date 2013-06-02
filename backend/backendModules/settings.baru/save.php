<?php
include "../../../adminAPI.php";
if($_POST["title"]){
	if(setSetting("LANGUAGE", $_POST["language"])){
		#echo "Language saved!";
	} else {
		$error = 1;
	}
	if(setSetting("HELLO_TEXT", htmlentities($_POST["helloText"]))){
		#echo "HELLO_TEXT saved!";
	} else {
		$error = 2;
	}
	if(setSetting("PAGE_TITLE", strip_Tags($_POST["title"]))){
		#echo "Pagetitle saved!";
	} else {
		$error = 3;
	}
	
	if($error){
		echo $error;
	} else {
		echo "success";
	}
}

if($_POST["wartungsmodus"]){
	if(getSetting("WARTUNG") == "1"){
		if(setSetting("WARTUNG", "0")){
			echo "success";
		}
	} else {
		if(setSetting("WARTUNG", $_POST["wartungsmodus"])){
			echo "success";
		}
	}
	echo getSetting("WARTUNG");
}

if($_POST["searchToggle"]){
	if(getSetting("SEARCH_ACTIVE") == "1"){
		if(setSetting("SEARCH_ACTIVE", "0")){
			echo "success";
		}
	} else {
		if(setSetting("SEARCH_ACTIVE", $_POST["searchToggle"])){
			echo "success";
		}
	}
	echo getSetting("SEARCH_ACTIVE");
}

if($_POST["searchMinLength"]){
	if(setSetting("SEARCH_MIN_LENGTH", $_POST["searchMinLength"])){
		echo "success";
	}
}



if($_POST["template"]){
	if(setSetting("TEMPLATE", $_POST["template"])){
		echo "success";
	}
}





if($_POST["bgFile"]){
	move_uploaded_file($_FILES['bgFile']['tmp_name'] ,$rootPath."/img/bg.png");
	echo "success";
}
?>