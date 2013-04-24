<?php
include "../../../adminAPI.php";

if($_GET["type"] == "groups"){
	//MySQLi
	$groupsQuery = $db->query("SELECT * FROM ".$db_prefix."Groups ORDER BY Name");
	while($groupsResult = $groupsQuery->fetch_object()) {
		if(!$fisrtItamMarked){
			$firstItem = " firstItem";
			$fisrtItamMarked = true;
		}
		echo '
			<div id="pageItem'.$groupsResult->ID.'" class="baruManagerItemGroups'.$firstItem.'" data-id="'.$groupsResult->ID.'">
				<b>'.$groupsResult->Name.'</b>
			</div>
		';
		$firstItem = false;
	}
} else {
	$userQuery = $db->query("SELECT * FROM ".$db_prefix."User ORDER BY Nachname");
	while($userResult = $userQuery->fetch_object()) {
		if(!$fisrtItamMarked){
			$firstItem = " firstItem";
			$fisrtItamMarked = true;
		}
		$usergroupQuery = $db->query("SELECT * FROM ".$db_prefix."Groups WHERE ID = '".$userResult->Group."'");
		$usergroupResult = $usergroupQuery->fetch_object();
		$groupname = $usergroupResult->Name;
		echo '
			<div id="pageItem'.$userResult->ID.'" class="baruManagerItem'.$firstItem.'" data-id="'.$userResult->ID.'">
				<b>'.$userResult->Vorname.' '.$userResult->Nachname.'</b>
				<p>'.$groupname.'</p>
			</div>
		';
		$firstItem = false;
	}
}
?>