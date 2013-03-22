<h1><? echo $lang_filemanager; ?></h1>
<script>
function openUploader(){
	$("#uploaderDialog").dialog("open");

	var buttons = $("#uploaderDialog").dialog("option", "buttons");
	$("#uploaderDialog").dialog("option", "buttons", [
		{
			text: "<? $lang_upload; ?>",
			click: function() {
				$(this).dialog("close");
				$("#fileUpload").submit();
			}
		}
	] );

}

function newFolder(){
	$("#newFolderDialog").dialog("open");

	var buttons = $("#newFolderDialog").dialog("option", "buttons");
	$("#newFolderDialog").dialog("option", "buttons", [
		{
			text: "<? echo $lang_save; ?>",
			click: function() {
				$(this).dialog("close");
				$("#newFolder").submit();
			}
		}
	] );

}

//Bild
function einbettenI(dateiname, fileID, fileURL){
	//var width = $("#einbettenIMG").dialog( "option", "width" );
	$("#einbettenIMG").dialog( "option", "width", 460 );

	$("#codeIMG").val("[img]"+fileURL+"[/img]");
	$("#codeDLIMG").val("<div id='dlButton' data-id='"+fileID+"'>Button wird geladen...</div>");
	$("#einbettenIMG").dialog("open");

	var buttons = $("#einbettenIMG").dialog("option", "buttons");
	$("#einbettenIMG").dialog("option", "buttons", [
		{
			text: "<? $lang_close; ?>",
			click: function() {
				$(this).dialog("close");
			}
		}
	] );
}

//Video
function einbettenV(dateiname, fileID){
	var width = $("#einbettenV").dialog( "option", "width" );
	$("#einbettenV").dialog( "option", "width", 460 );

	$("#codeV").val("<div id='video' data-id='"+fileID+"' data-width='960' data-height='540'><? echo $lang_videoPlayerLoading; ?></div>");
	$("#codeDLV").val("<div id='dlButton' data-id='"+fileID+"'>Button wird geladen...</div>");
	$("#einbettenV").dialog("open");

	var buttons = $("#einbetten>").dialog("option", "buttons");
	$("#einbetten>").dialog("option", "buttons", [
		{
			text: "<? echo $lang_close; ?>",
			click: function() {
				$(this).dialog("close");
			}
		}
	] );
}

function einbettenOther(dateiname, fileID){
	var width = $("#einbetten").dialog( "option", "width" );
	$("#einbetten").dialog( "option", "width", 460 );

	$("#codeDL").val("<div id='dlButton' data-id='"+fileID+"'>Button wird geladen...</div>");
	$("#einbetten").dialog("open");

	var buttons = $("#einbetten").dialog("option", "buttons");
	$("#einbetten").dialog("option", "buttons", [
		{
			text: "<? echo $lang_close; ?>",
			click: function() {
				$(this).dialog("close");
			}
		}
	] );
}

function delFile(fID, fName){
	$("#deleteDialog").dialog("open");
	$("#fileName").html(fName);
	
	var buttons = $("#deleteDialog").dialog("option", "buttons");
	$("#deleteDialog").dialog("option", "buttons", [
		{
			text: "<? echo $lang_deleteFile; ?>",
			click: function() {
				$(this).dialog("close");
				document.location.href = "admin.php?p=files&folder=<? echo $_GET["folder"]; ?>&action=delete&fID="+fID;
			}
		}
	] );
}

function openFolder(fID){
	document.location.href = "?p=files&folder="+fID;
}
</script>
<div id="einbetten" style="font-size: 10pt;" title="Datei einbetten">
	<b><? echo $lang_asLink; ?>:</b><br><input type="text" id="codeDL" size="50" />
</div>

<div id="einbettenIMG" style="font-size: 10pt;" title="Bild einbetten">
	<b><? echo $lang_withPreview; ?>:</b><br><input type="text" id="codeIMG" size="50" />
	<br>
	<b><? echo $lang_asLink; ?>:</b><br><input type="text" id="codeDLIMG" size="50" />
</div>

<div id="einbettenV" style="font-size: 10pt;" title="Video einbetten">
	<b><? echo $lang_withPreview; ?>:</b><br><input type="text" id="codeV" size="50" />
	<br>
	<b><? echo $lang_asLink; ?>:</b><br><input type="text" id="codeDLV" size="50" />
</div>

<div id="deleteDialog" title="<? echo $lang_confirmDelete; ?>">
	<h3><? echo $lang_confirmDeleteFile1; ?> "<span id="fileName" style="font-style: italic;"></span>" <? echo $lang_confirmDeleteFile2; ?></h3>
</div>
<?
if($ECM["rights"]["ADD_FILE"]){
	?>
	<div id="uploaderDialog" title="Uploader">
		<h3><? echo $lang_chooseFile; ?>:</h3>
		<form id="fileUpload" method="post" action="?p=files&action=upload&folder=<? echo $_GET["folder"]; ?>" enctype="multipart/form-data">
			<input type="file" name="datei" />
		</form>
	</div>
	<button id="button" class="ui-state-default ui-corner-all right" onclick="openUploader()"><? echo $lang_uploadFile; ?></button>
	<div class="clear"></div>
	<?
}

if($ECM["rights"]["ADD_FOLDER"]){
?>
	<div id="newFolderDialog" title="<? echo $lang_newFolder; ?>">
		<h3><? echo $lang_newFolder; ?>:</h3>
		<form id="newFolder" method="post" action="?p=files&action=newFolder&folder=<? echo $_GET["folder"]; ?>">
			<input type="text" name="name" placeholder="<? echo $lang_newFolder; ?>" />
		</form>
	</div>
	<button id="button" class="ui-state-default ui-corner-all right" onclick="newFolder()"><? echo $lang_newFolder; ?></button>
	<div class="clear"></div>
<?
}
?>
<br>
<?
if($_GET["action"] == "newFolder" && $ECM["rights"]["ADD_FOLDER"]){
	mysql_query("INSERT INTO `Files` VALUES ('', 'folder', '".$_POST["name"]."', '0', '".$ECM["userID"]."', '".time()."', '".$_GET["folder"]."')", $mysql);
	?>
	<script>
	function weiterleitung(){
		document.location.href = "?p=files&folder=<? echo $_GET["folder"]; ?>";
	}
	setTimeout(weiterleitung, 1500);
	</script>
	<?
}

if($_GET["action"] == "delete" && $ECM["rights"]["DELETE_FILE"]){
	$fileDel_abfrage = mysql_query("SELECT * FROM Files WHERE ID = ".$_GET["fID"], $mysql);
	$fileDel = mysql_fetch_array($fileDel_abfrage);
	unlink("download/".$fileDel["Code"]."_".$fileDel["Name"]);
	mysql_query("DELETE FROM Files WHERE ID = ".$_GET["fID"], $mysql);
	?>
	<script>
	function weiterleitung(){
		document.location.href = "?p=files&folder=<? echo $_GET["folder"]; ?>";
	}
	setTimeout(weiterleitung, 1500);
	</script>
	<?
}

if(!$_GET["folder"]){
	$currentFolder = 0;
} else {
	$currentFolder = $_GET["folder"];
}

if($_GET["action"] == "upload" && $ECM["rights"]["ADD_FILE"]){
	$file = $_FILES['datei']['tmp_name'];
	$file_exists_abfrage = mysql_query("SELECT * FROM ".$db_prefix."Files WHERE Name = '".sonderzeichen($_FILES['datei']['name'])."' AND Folder = '".$currentFolder."'", $mysql);
	if($f2 = mysql_fetch_array($file_exists_abfrage)){
		move_uploaded_file($_FILES['datei']['tmp_name'], "download/".$f2["Code"]);
		mysql_query("UPDATE `Files` SET `Datum` = '".time()."' WHERE ID = ".$f2["ID"], $mysql);
		echo mysql_error();
	} else {
		$zufall = zufallsstring(16);
		move_uploaded_file($_FILES['datei']['tmp_name'], "download/".$zufall."_".sonderzeichen($_FILES["datei"]["name"]));
		mysql_query("INSERT INTO `Files` VALUES ('', '".$_FILES['datei']['type']."', '".sonderzeichen($_FILES["datei"]["name"])."', '".$zufall."', '".$ECM["userID"]."', '".time()."', '".$_GET["folder"]."')", $mysql);
		echo mysql_error();
	}
	hinweis($lang_fileUploaded);
	?>
	<script>
	function weiterleitung(){
		document.location.href = "?p=files&folder=<? echo $_GET["folder"]; ?>";
	}
	setTimeout(weiterleitung, 1500);
	</script>
	<?
}
?>
<table id="filesList">
	<thead>
		<td></td>
		<td><? echo $lang_filename; ?></td>
		<td><? echo $lang_filetype; ?></td>
		<td><? echo $lang_author; ?></td>
		<td><? echo $lang_lastChange; ?></td>
		<td><? echo $lang_actions; ?></td>
	</thead>
	<?
	$folder_abfrage = mysql_query("SELECT * FROM ".$db_prefix."Files WHERE Typ = 'folder' AND Folder = ".$currentFolder, $mysql);
	if(mysql_error()){
		fehler(mysql_error());
	}
	while($folder = mysql_fetch_array($folder_abfrage)){
		?>
		<tr>
			<td onclick="openFolder('<? echo $folder["ID"]; ?>')">0</td>
			<td onclick="openFolder('<? echo $folder["ID"]; ?>')"><? echo $folder["Name"]; ?></td>
			<td onclick="openFolder('<? echo $folder["ID"]; ?>')"><? echo $folder["Typ"]; ?></td>
			<td>
			<?
			$autor = mysql_query("SELECT * FROM ".$db_prefix."User WHERE ID = ".$folder["Uploader"], $mysql);
			if(mysql_error()){
				$autor = $lang_unbekannt; 
			}
			$a = mysql_fetch_array($autor);
			$autor = $a["Vorname"]." ".$a["Nachname"]; 
			echo $autor;
			?>
			</td>
			<td onclick="openFolder('<? echo $folder["ID"]; ?>')"><? echo date("d.m.Y - H:i", $folder["Datum"]); ?></td>
			<td><button id="button" class="ui-state-default ui-corner-all right" onclick="delFile('<? echo $folder["ID"]; ?>', '<? echo $folder["Name"]; ?>')"><? echo $lang_delete; ?></button></td>
		</tr>
		<?
	}
	if($_GET["folder"]){
		$folder2_abfrage = mysql_query("SELECT * FROM ".$db_prefix."Files WHERE ID = ".$currentFolder, $mysql);
		$folder2 = mysql_fetch_array($folder2_abfrage);
		?>
		<tr class="parentFolder" onclick="openFolder('<? echo $folder2["Folder"]; ?>')">
			<td>-1</td>
			<td>parent folder</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?
	}

	$files_abfrage = mysql_query("SELECT * FROM ".$db_prefix."Files WHERE Typ != 'folder'  AND Folder = ".$currentFolder, $mysql);
	if(mysql_error()){
		fehler(mysql_error());
	}
	while($f = mysql_fetch_array($files_abfrage)){
		?>
		<tr>
			<td>1</td>
			<td><? echo $f["Name"]; ?></td>
			<td><? echo $f["Typ"]; ?></td>
			<td>
			<?
			$autor = mysql_query("SELECT * FROM ".$db_prefix."User WHERE ID = ".$f["Uploader"], $mysql);
			if(mysql_error()){
				$autor = $lang_unbekannt; 
			}
			$a = mysql_fetch_array($autor);
			$autor = $a["Vorname"]." ".$a["Nachname"]; 
			echo $autor;
			?>
			</td>
			<td><? echo date("d.m.Y - H:i", $f["Datum"]); ?></td>
			<td>
				<button id="button" class="ui-state-default ui-corner-all right" onclick="delFile('<? echo $f["ID"]; ?>', '<? echo $f["Name"]; ?>')"><? echo $lang_delete; ?></button>
				<?
				if($f["Typ"] == "image/png" or $f["Typ"] == "image/jpeg"){
					?>
					<button id="button" class="ui-state-default ui-corner-all right" onclick="einbettenI('<? echo $f["Name"]; ?>', '<? echo $f["ID"]; ?>', 'download/<? echo $f["Code"]."_".$f["Name"]; ?>')"><? echo $lang_einbetten; ?></button>
					<?
				} else if($f["Typ"] == "video/webm" or $f["Typ"] == "video/mp4"){
					?>
					<button id="button" class="ui-state-default ui-corner-all right" onclick="einbettenV('<? echo $f["Name"]; ?>', '<? echo $f["ID"]; ?>')"><? echo $lang_einbetten; ?></button>
					<?
				}else {
					?>
					<button id="button" class="ui-state-default ui-corner-all right" onclick="einbettenOther('<? echo $f["Name"]; ?>', '<? echo $f["ID"]; ?>')"><? echo $lang_einbetten; ?></button>
					<?
				}
				?>
			</td>
		</tr>
		<?
	}
	?>
</table>