<?php
include "../../../adminAPI.php";

//MySQLi
$catQuery = $db->query("SELECT * FROM ".$db_prefix."Categories ORDER BY Name");

while($catResult = $catQuery->fetch_object()) {
	if(!$fisrtItamMarked){
		$firstItem = " firstItem";
		$fisrtItamMarked = true;
	}
	echo '
		<div id="catItem'.$catResult->ID.'" class="baruManagerCatItem'.$firstItem.'" data-id="'.$catResult->ID.'" data-url="'.$catResult->url.'">
			<b>'.$catResult->Name.'</b>
		</div>
	';
	$firstItem = false;
}
?>