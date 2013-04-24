<?php
include "../../../adminAPI.php";
//MySQLi
$catQuery = $db->query("SELECT * FROM ".$db_prefix."Categories WHERE ID = '".$_GET["catID"]."'");
$catResult = $catQuery->fetch_object();
?>
<table>
	<tr>
		<td><label for="name"><b>Name:</b></label></td>
		<td><input type="text" id="name" value="<?php echo $catResult->Name; ?>"></td>
	</tr>
	<tr>
		<td><label for="url"><b>URL:</b></label></td>
		<td><input type="text" id="url" value="<?php echo $catResult->url; ?>"></td>
	</tr>
	<tr>
		<td><label for="visibility"><b>Sichtbarkeit:</b></label></td>
		<td>
			<select id="visibility">
				<option disabled selected>Sichtbarkeit w&auml;hlen</option>
				<?php
				if($catResult->visibility == "public"){
					echo '<option value="public" selected>&Ouml;ffentlich</option>';
				} else {
					echo '<option value="public">&Ouml;ffentlich</option>';
				}
				
				if($catResult->visibility == "private"){
					echo '<option value="private" selected>Privat</option>';
				} else {
					echo '<option value="private">Privat</option>';
				}
				
				if($catResult->visibility == "hidden"){
					echo '<option value="hidden" selected>Versteckt</option>';
				} else {
					echo '<option value="hidden">Versteckt</option>';
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td><input type="hidden" id="catID" value="<?php echo $catResult->ID; ?>"></td>
		<td><button onclick="saveCat()" class="ui-state-default ui-corner-all">Speichern</button><span id="ajaxStatusCat"></span></td>
	</tr>
</table>