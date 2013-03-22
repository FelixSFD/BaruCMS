<h1><? echo $lang_menuManagement; ?></h1>
<?
if(!$_GET["menu"] && !$_GET["new"] && !$_GET["action"]){
	if($_GET["delete"] == true && $ECM["rights"]["DELETE_MENU"]){
		mysql_query("DELETE FROM `".$db_prefix."Menu` WHERE ID = ".$_GET["mID"], $mysql);
		hinweis($lang_menuDeleted);
		?>
		<script>
		function weiterleitung(){
			document.location.href = "?p=menu";
		}
		//setTimeout(weiterleitung, 2200);
		</script>
		<?
	}
	
	if($ECM["rights"]["DELETE_MENU"]){
		?>
		<div id="deleteDialog" title="<? echo $lang_confirmDeleteMenu; ?>">
			<h3><? echo $lang_confirmDeleteMenu1; ?> "<span id="menuName" style="font-style: italic;"></span>" <? echo $lang_confirmDeleteMenu2; ?></h3>
		</div>
		<div id="delLoader">
		</div>
		<?
	}
	?>
	<script>
	function delMenu(mID, mName){
		$("#deleteDialog").dialog("open");
		$("#menuName").html(mName);
		
		var buttons = $("#deleteDialog").dialog("option", "buttons");
		$("#deleteDialog").dialog("option", "buttons", [
			{
				text: "<? echo $lang_deleteMenu; ?>",
				click: function() {
					$(this).dialog("close");
					document.location.href = "admin.php?p=menu&delete=true&mID="+mID;
				}
			}
		] );
	}
	
	function editMenu(mID){
		document.location.href = "admin.php?p=menu&menu="+mID;
	}
	
	function newMenu(){
		document.location.href = "admin.php?p=menu&new=true";
	}
	</script>
	<h2><? echo $lang_mainMenu; ?></h2>
	<?
	if($ECM["rights"]["ADD_MENU"]){
		?>
		<div id="userNewMenu" class="right">
			<button class="ui-state-default ui-corner-all right" onclick="newMenu()"><? echo $lang_mainMenuNewLink; ?></button>
		</div>
		<div class="clear"></div>
		<?
	}
	?>
	<table id="menuList">
		<thead>
			<td>ID</td>
			<td><? echo $lang_adminbereichPagesListTitle; ?></td>
			<td><? echo $lang_link; ?></td>
			<td><? echo $lang_superordinateLink; ?></td>
			<td><? echo $lang_actions; ?></td>
		</thead>
		<?
		$menu = mysql_query("SELECT * FROM ".$db_prefix."Menu", $mysql);
		if(mysql_error()){
			fehler(mysql_error());
		}
		while ($m = mysql_fetch_array($menu)) {
			?>
			<tr>
				<td><? echo $m["ID"]; ?></td>
				<td><? echo $m["Titel"]; ?></td>
				<td><? echo $m["Link"]; ?></td>
				<td>
					<?
					if($m["mainMenu"] > 0){
						$mainMenu = mysql_query("SELECT * FROM ".$db_prefix."Menu WHERE ID = ".$m["mainMenu"], $mysql);
						while ($mainM = mysql_fetch_array($mainMenu)) {
							echo $mainM["Titel"];
						}
					} else if($m["mainMenu"] == 0){
						echo "Main menu";
					} else if($m["mainMenu"] == -1){
						echo "Footer";
					}
					?>
				</td>
				<td>
					<?
					if($ECM["rights"]["DELETE_MENU"]){
					?>
					<button onclick="delMenu('<? echo $m["ID"]; ?>', '<? echo $m["Titel"]; ?>')" class="ui-state-default ui-corner-all right"><? echo $lang_delete; ?></button>
					<?
					}
					
					if($ECM["rights"]["EDIT_MENU"]){
					?>
					<button class="ui-state-default ui-corner-all right"onclick="editMenu('<? echo $m["ID"]; ?>')"><? echo $lang_edit; ?></button>
					<?
					}
					?>
				</td>
			</tr>
			<?
		}
		?>
	</table>
	<?
} else if(!$_GET["menu"] && $_GET["new"] && $ECM["rights"]["ADD_MENU"]){
	?>
	<h2>Neuen Menüpunkt anlegen</h2>
	<div id="newMenuForm">
		<form method="post" action="?p=menu&action=new">
			<label for="title"><b>Titel: </b></label>
			<input type="text" id="title" name="titel" placeholder="Linktext" size="59"><br>
			<!--<label for="page"><b>Ziel: http://<? echo $_SERVER["HTTP_HOST"].str_replace("admin.php", "index.php", $_SERVER["PHP_SELF"]); ?>?p=</b></label>
			<input type="number" id="page" name="page" placeholder="ID" size="4"><br>-->
			
			<label for="page"><b>Ziel:</b>
				<select id="selectPage" name="selectPage" onchange="setPage()">
					<option value="-1" disabled selected>---Seite wählen---</option>
					<?
					$menuPages = mysql_query("SELECT * FROM ".$db_prefix."Pages", $mysql);
					while($menuP = mysql_fetch_array($menuPages)) {
						?>
						<option value="<? echo $menuP["ID"]; ?>"><? echo $menuP["Titel"]; ?></option>
						<?
					}
					?>
					<option value="-1">---Menükategorie---</option>
					<option value="0">---externer Link---</option>
				</select>
				<div id="externerLinkBox" style="display: none;">
					URL:<input type="text" id="linkTarget" name="page">
				</div>
			<br>
			<label for="mainMenu"><b>Übergeordneter Menüpunkt:</b></label>
			<select id="mainMenu" name="mainMenu">
				<option value="0">keiner</option>
				<option value="-1">Footer</option>
				<?
				$mainMenu = mysql_query("SELECT * FROM ".$db_prefix."Menu WHERE Sichtbarkeit = 1", $mysql);
				while ($mainM = mysql_fetch_array($mainMenu)) {
					?>
					<option value="<? echo $mainM["ID"]; ?>"><? echo $mainM["Titel"]." (".$mainM["ID"].")"; ?></option>
					<?
				}
				
				?>
			</select>
			<br>
			<input type="checkbox" value="1" name="visible" id="visible"><label for="visible"><b>Öffentlich?</b><small>(muss bei jeder Änderung erneut bestätigt werden!)</small></label>
			<br>
			<button type="submit">Speichern!</button>
		</form>
	</div>
	<?
} else if(!$_GET["menu"] && $_GET["new"]){
	fehler($lang_noPermission);
} else if($_GET["action"] == "new" && $ECM["rights"]["ADD_MENU"]){
	if($_POST["selectPage"] == "0"){
		$link = $_POST["page"];
	} else if($_POST["selectPage"] == "-1"){
		$link = "#";
	} else if($_POST["selectPage"] > 0){
		$pagesInfo = mysql_query("SELECT * FROM ".$db_prefix."Pages WHERE ID = ".$_POST["page"], $mysql);
		while($pagesI = mysql_fetch_array($pagesInfo)) {
			$link = $pagesI["url"].".html";
		}
	}
	mysql_query("INSERT INTO `".$db_prefix."Menu` VALUES ('', '".$_POST["titel"]."', '".$link."', '".$_POST["visible"]."', '".$_POST["mainMenu"]."')", $mysql);
	?>
	<script>
	function weiterleitung(){
		document.location.href = "?p=menu";
	}
	setTimeout(weiterleitung, 2500);
	</script>
	<?
	if(mysql_error()){
		fehler(mysql_error());
	} else {
		hinweis("Menüpunkt gespeichert!");
	}
} else if($_GET["menu"] > 0 && $ECM["rights"]["EDIT_MENU"]){
	?>
	<h2>Menüpunkt bearbeiten</h2>
	<?
	if($_GET["action"] == "save"){
		if($_POST["selectPage"] == "0"){
			$link = $_POST["page"];
		} else if($_POST["selectPage"] == "-1"){
			$link = "#";
		} else if($_POST["selectPage"] > 0){
			$pagesInfo = mysql_query("SELECT * FROM Pages WHERE ID = ".$_POST["page"], $mysql);
			while($pagesI = mysql_fetch_array($pagesInfo)) {
				$link = $pagesI["url"].".html";
			}
		}
		mysql_query("UPDATE `".$db_prefix."Menu` SET `Titel` = '".$_POST["titel"]."' WHERE ID = ".$_GET["menu"], $mysql);
		mysql_query("UPDATE `".$db_prefix."Menu` SET `Link` = '".$link."' WHERE ID = ".$_GET["menu"], $mysql);
		mysql_query("UPDATE `".$db_prefix."Menu` SET `Sichtbarkeit` = '".$_POST["visible"]."' WHERE ID = ".$_GET["menu"], $mysql);
		mysql_query("UPDATE `".$db_prefix."Menu` SET `mainMenu` = '".$_POST["mainMenu"]."' WHERE ID = ".$_GET["menu"], $mysql);
		hinweis("Menüpunkt gespeichert!");
	}
	
	$menu = mysql_query("SELECT * FROM ".$db_prefix."Menu WHERE ID = ".$_GET["menu"], $mysql);
	if(mysql_error()){
		fehler(mysql_error());
	}
	$m = mysql_fetch_array($menu);
	?>
	<div id="editMenuForm">
		<form method="post" action="?p=menu&menu=<? echo $_GET["menu"]; ?>&action=save">
			<label for="title"><b>Titel: </b></label>
			<input type="text" id="title" name="titel" placeholder="Linktext" size="59" value="<? echo $m["Titel"]; ?>"><br>
			<label for="page"><b>Ziel:</b>
				<select id="selectPage" name="selectPage" onchange="setPage()">
					<option value="-1" disabled>---Seite wählen---</option>
					<?
					$selected = "selected";
					
					$menuPages = mysql_query("SELECT * FROM ".$db_prefix."Pages", $mysql);
					while($menuP = mysql_fetch_array($menuPages)) {
						if($menuP["url"].".html" == $m["Link"]){
							?>
							<option value="<? echo $menuP["ID"]; ?>" selected><? echo $menuP["Titel"]; ?></option>
							<?
							$selected = "";
						} else {
													?>
							<option value="<? echo $menuP["ID"]; ?>"><? echo $menuP["Titel"]; ?></option>
							<?

						}
					}
					
					if($m["Link"] == "#"){
						?>
						<option value="-1" selected>---Menükategorie---</option>
						<?
						$selected = "";
					} else {
					?>
						<option value="-1">---Menükategorie---</option>
						<?
					}
					?>
					<option value="0" <? echo $selected; ?>>---externer Link---</option>
				</select>
				<?
				if($selected == "selected"){
					?>
					<div id="externerLinkBox">
						URL:<input type="text" id="linkTarget" name="page" value="<? echo $m["Link"]; ?>">
					</div>
					<?
				} else {
					?>
					<div id="externerLinkBox" style="display: none;">
						URL:<input type="text" id="linkTarget" name="page" value="<? echo $m["Link"]; ?>">
					</div>
					<?
				}
				?>
			<br>
			<label for="mainMenu"><b>Übergeordneter Menüpunkt:</b></label>
			<select id="mainMenu" name="mainMenu">
				<?
				if($m["mainMenu"] == "0"){
					?>
					<option value="0">keiner</option>
					<?
				}
				if($m["mainMenu"] == "-1"){
					?>
					<option value="-1">Footer</option>
					<?
				}
				
				
				$mainMenu = mysql_query("SELECT * FROM ".$db_prefix."Menu WHERE Sichtbarkeit = 1", $mysql);
				while ($mainM = mysql_fetch_array($mainMenu)) {
					if($m["mainMenu"] == $mainM["ID"]){
						?>
						<option value="<? echo $mainM["ID"]; ?>" selected><? echo $mainM["Titel"]." (".$mainM["ID"].")"; ?></option>
						<?
					} else {
						?>
						<option value="<? echo $mainM["ID"]; ?>"><? echo $mainM["Titel"]." (".$mainM["ID"].")"; ?></option>
						<?
					}
				}
				
				?>
			</select>
			<br>
			<input type="checkbox" value="1" name="visible" id="visible"><label for="visible"><b>Öffentlich?</b><small>(muss bei jeder Änderung erneut bestätigt werden!)</small></label>
			<br>
			<button type="submit">Speichern!</button>
		</form>
	</div>
	<?
} else if($_GET["menu"] > 0){
	fehler($lang_noPermission);
}
?>