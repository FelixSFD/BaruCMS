<?php
include "../../../adminAPI.php";

//MySQLi
$pagesQuery = $db->query("SELECT * FROM ".$db_prefix."Pages ORDER BY Datum DESC");

while($pagesResult = $pagesQuery->fetch_object()) {
	if(strlen(strip_tags($pagesResult->Inhalt)) > 100){
		$shortened = "...";
	}
	if(!$fisrtItamMarked){
		$firstItem = " firstItem";
		$fisrtItamMarked = true;
	}
	echo '
		<div id="pageItem'.$pagesResult->ID.'" class="baruManagerItem'.$firstItem.'" data-id="'.$pagesResult->ID.'" data-url="'.$pagesResult->url.'">
			<div class="date">'.date("d.m.y - H:i", $pagesResult->Datum).'</div>
			<b>'.$pagesResult->Titel.'</b>
			<p>'.substr(strip_tags($pagesResult->Inhalt), 0, 100).$shortened.'</p>
		</div>
	';
	$firstItem = false;
}
?>