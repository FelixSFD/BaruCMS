<?php
include_once "../../../adminAPI.php";

if(getRights("EDIT_USERGROUPS", $userinfo["Group"])){
	$allRights = array("EDIT_USER", 
		"EDIT_USERGROUPS",
		"EDIT_PAGES",
		"UPDATE_SETTINGS",
		"UPDATE_SYSTEM",
		"VIEW_SYSTEM_INFO");
		
	foreach($allRights as $right){
		echo setRights($right, $_POST[$right], $_POST["groupID"]);
	}
	echo "success";
} else {
	echo errorcode(403);
}
?>