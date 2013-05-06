<?php
include "../../../adminAPI.php";

$pages = new baruSQL("SELECT * FROM ".$db_prefix."Pages WHERE ID = '".$_GET["pageID"]."'");
foreach($pages->returnData("object") as $pagesResult){
	?>
	<style>
	.baruEditorFullSize{
	width: 100%;
	padding-right: 10px;
	}
	</style>
	<!--<label for="title">&Uuml;berschrift:</label>-->
	<input type="text" id="title" value="<?php echo $pagesResult->Titel; ?>" size="80" /><br>
	<label for="type"><b> Typ: </b></label>
	<select id="type">
		<?php
		if($pagesResult->im_Blog == "1"){
			echo '<option value="1" selected>Blogeintrag</option>';
			echo '<option value="0">Seite</option>';
		} else {
			echo '<option value="1">Blogeintrag</option>';
			echo '<option value="0" selected>Seite</option>';
		}
		?>
	</select>
	<input type="hidden" id="id" value="<?php echo $pagesResult->ID; ?>" />
	<label for="category"><b>Kategorie:</b></label>
	<select id="category">
		<option disabled selected>Kategorie w&auml;hlen</option>
		<?php
		$catQuery = $db->query("SELECT * FROM ".$db_prefix."Categories ORDER BY Name");
		while($catResult = $catQuery->fetch_object()) {
			if($pagesResult->Category == $catResult->ID){
				echo '<option value="'.$catResult->ID .'" selected>'.$catResult->Name .'</option>';
			} else {
				echo '<option value="'.$catResult->ID .'">'.$catResult->Name .'</option>';
			}
		}
		?>
	</select>
	<br>
	<textarea id="inhalt" class="advancedEditor baruEditorFullSize"><?php echo $pagesResult->Inhalt; ?></textarea><br>
	<button onclick="save()" class="ui-state-default ui-corner-all">Speichern</button><span id="ajaxStatus"></span>
	<?php
}
?>