<?php
include "../../../adminAPI.php";

$categories = new baruSQL("SELECT * FROM ".$db_prefix."Categories ORDER BY Name");
foreach($categories->returnData("object") as $catResult){
	echo '
		<div id="catItem'.$catResult->ID.'" class="baruManagerCatItem'.$firstItem.'" data-id="'.$catResult->ID.'" data-url="'.$catResult->url.'">
			<b>'.strip_tags($catResult->Name).'</b>
		</div>
	';
}
?>