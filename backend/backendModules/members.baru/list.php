<?php
include "../../../adminAPI.php";

if($_GET["type"] == "groups"){
	$groups = new baruSQL("SELECT * FROM ".$db_prefix."Groups ORDER BY Name");
	$groupsArray = $groups->returnData("object");
	foreach($groups->returnData("object") as $groupsResult){
		echo '
			<div id="pageItem'.$groupsResult->ID.'" class="baruManagerItemGroups" data-id="'.$groupsResult->ID.'">
				<b>'.$groupsResult->Name.'</b>
			</div>
		';
	}
} else {
	$user = new baruSQL("SELECT * FROM ".$db_prefix."User ORDER BY Nachname");
	foreach($user->returnData("object") as $userResult){
		$usergroup = new baruSQL("SELECT * FROM ".$db_prefix."Groups WHERE ID = '".$userResult->Group."'");
		$usergroupResult = $usergroup->returnData("array");
		$groupname = $usergroupResult[0]["Name"];
		echo '
			<div id="pageItem'.$userResult->ID.'" class="baruManagerItem'.$firstItem.'" data-id="'.$userResult->ID.'">
				<b>'.$userResult->Vorname.' '.$userResult->Nachname.'</b>
				<p>'.$groupname.'</p>
			</div>
		';
	}
}
?>