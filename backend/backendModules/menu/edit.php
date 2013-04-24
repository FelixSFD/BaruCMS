<?php
include_once "../../../adminAPI.php";

$menuQuery = $db->query("SELECT * FROM ".$db_prefix."Menu WHERE ID = '".$_GET["menuID"]."'");
$menuResult = $menuQuery->fetch_object();
?>
<table>
	<tr>
		<td><label for="Titel"><b>Titel:</b></label></td>
		<td><input type="text" value="<?php echo $menuResult->Titel; ?>"></td>
	</tr>
	<tr>
		<td><label for="page"><b>Ziel:</b></label></td>
		<td>
			<select id="selectPage" name="selectPage" onchange="setPage()">
				<option value="-1" disabled>---Seite wählen---</option>
				<?php
				$selected = "selected";
				
				$menuPages = mysql_query("SELECT * FROM ".$db_prefix."Pages", $mysql);
				while($menuP = mysql_fetch_array($menuPages)) {
					if($menuP["url"].".html" == $m["Link"]){
						?>
						<option value="<?php echo $menuP["ID"]; ?>" selected><?php echo $menuP["Titel"]; ?></option>
						<?php
						$selected = "";
					} else {
						?>
						<option value="<?php echo $menuP["ID"]; ?>"><? echo $menuP["Titel"]; ?></option>
						<?php

					}
				}
				
				if($m["Link"] == "#"){
					?>
					<option value="-1" selected>---Menükategorie---</option>
					<?php
					$selected = "";
				} else {
				?>
					<option value="-1">---Menükategorie---</option>
					<?php
				}
				?>
				<option value="0" <?php echo $selected; ?>>---externer Link---</option>
			</select>
			<?php
			if($selected == "selected"){
				?>
				<div id="externerLinkBox">
					URL:<input type="text" id="linkTarget" name="page" value="<?php echo $m["Link"]; ?>">
				</div>
				<?php
			} else {
				?>
				<div id="externerLinkBox" style="display: none;">
					URL:<input type="text" id="linkTarget" name="page" value="<?php echo $m["Link"]; ?>">
				</div>
				<?php
			}
			?>
		</td>
	</tr>
</table>