<?php
include "../../../adminAPI.php";

$pages = new baruSQL("SELECT * FROM ".$db_prefix."Pages ORDER BY Datum DESC");
$pagesArray = $pages->returnData("object");
foreach($pages->returnData("object") as $pagesResult){
	if(strlen(strip_tags($pagesResult->Inhalt)) > 100){
		$shortened = "...";
	}
	echo '
		<div id="pageItem'.$pagesResult->ID.'" class="baruManagerItem'.$firstItem.'" data-id="'.$pagesResult->ID.'" data-url="'.$pagesResult->url.'">
			<div class="date">'.date("d.m.y - H:i", $pagesResult->Datum).'</div>
			<b>'.strip_tags($pagesResult->Titel).'</b>
			<p>'.substr(strip_tags(html_entity_decode($pagesResult->Inhalt)), 0, 100).$shortened.'</p>
		</div>
	';
}
?>