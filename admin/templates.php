<?
if($ECM["rights"]["MANAGE_TEMPLATES"]){
?>
<h1><? echo $lang_templates; ?></h1>
<script>
function deleteTemplate(tName){
	document.location.href = "admin.php?p=templates&delete="+tName;
}

function openHelp(){
	$("#templatesHelp").dialog("open");
}

function activateTemplate(tName){
	document.location.href = "admin.php?p=templates&activate="+tName;
}
</script>
<?
if($_GET["action"] == "install-template"){
	if($_FILES['datei']['type'] == "application/zip"){
		move_uploaded_file($_FILES['datei']['tmp_name'], "template/".$_FILES['datei']['name']);
		$zip = new ZipArchive;
		$res = $zip->open("template/".$_FILES['datei']['name']);
		if ($res === TRUE) {
			$zip->extractTo("template/");
			$zip->close();
			hinweis($lang_unzipOK);
		} else {
			fehler($lang_unzipFailed);
		}
		unlink("template/".$_FILES['datei']['name']);
	} else {
		fehler($lang_notZip.$_FILES['datei']['type']);
	}
}
	
if($_GET["delete"]){
	$dir = "templates/".$_GET["delete"]; 
	$files = glob($dir.'/*.*');
	if ( !empty($files) ) {
		foreach ($files as $file) {
			unlink($file);
		}
	}
	rmdir($dir); 
}

if($_GET["activate"]){
	setSetting("TEMPLATE", $_GET["activate"]);
}
?>
<div id="templatesHelp" title="<? echo $lang_help; ?>">
	<p>
	<? echo $lang_templatesHelpText; ?>
	</p>
</div>
<a href="#" onclick="openHelp()"><? echo $lang_help; ?></a>
<div id="accordion">
	<h2><a href="#"><? echo $lang_templatesList; ?></a></h2>
	<div>
	<table id="pluginsTable">
		<thead>
			<td>ID</td>
			<td><? echo $lang_templatesName; ?></td>
			<td><? echo $lang_actions; ?></td>
		</thead>
	<?
	$verz = "templates/";
	$dateien = scandir($verz);
	foreach($dateien as $t) {
		if($t != "." && $t != ".." && $t != "readme.txt"){
			$info = file("templates/".$t."/info.txt");
			$anzahl++;
			?>
			<tr>
				<td>
					<? echo $anzahl; ?>
				</td>
				<td>
					<? echo $info[0]; ?>
				</td>
				<td>
					<?php
					if(getSetting("TEMPLATE") == $t){
						?>
						<button class="ui-state-default ui-corner-all right" style="color: grey;" onclick="deleteTemplate('<? echo $t; ?>')" disabled><? echo $lang_delete; ?></button>
						<?php
					} else {
						?>
						<button class="ui-state-default ui-corner-all right" onclick="deleteTemplate('<? echo $t; ?>')"><? echo $lang_delete; ?></button>
						<button class="ui-state-default ui-corner-all right" onclick="activateTemplate('<? echo $t; ?>')"><? echo $lang_templatesActivate; ?></button>
						<?php
					}
					?>
				</td>
			</tr>
			<?
		}
	};
	?>
	</table>
	</div>

	<h2><a href="#"><? echo $lang_addTemplates; ?></a></h2>
	<div>
	<form id="fileUpload" method="post" action="?p=templates&action=install-template" enctype="multipart/form-data">
		<label for="datei"><? echo $lang_templateFile; ?>:</label>
		<input type="file" name="datei" id="datei" required="required" /><br><br>
		<button id="button" class="ui-state-default ui-corner-all" type="submit"><? echo $lang_upload; ?></button>
	</form>
	<p>Alternativ kannst du das Template (entpackt) im Verzeichnis /templates ablegen.</p>
	</div>
</div>
<?
} else {
	fehler($lang_noPermission);
}
?>