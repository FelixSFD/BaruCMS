<?
if($ECM["rights"]["MANAGE_PLUGINS"]){
?>
<h1><? echo $lang_pluginManager; ?></h1>
<script>
function deletePlugin(pName){
	document.location.href = "admin.php?p=plugins&delete="+pName;
}

function openHelp(){
	$("#pluginsHelp").dialog("open");
}
</script>
<?
if($_GET["action"] == "install-plugin"){
	if($_FILES['datei']['type'] == "application/zip"){
		move_uploaded_file($_FILES['datei']['tmp_name'], "plugins/".$_FILES['datei']['name']);
		$zip = new ZipArchive;
		$res = $zip->open("plugins/".$_FILES['datei']['name']);
		if ($res === TRUE) {
			$zip->extractTo("plugins/");
			$zip->close();
			hinweis($lang_unzipOK);
		} else {
			fehler($lang_unzipFailed);
		}
		unlink("plugins/".$_FILES['datei']['name']);
	} else {
		fehler($lang_notZip.$_FILES['datei']['type']);
	}
}
	
if($_GET["delete"]){
	$dir = "plugins/".$_GET["delete"]; 
	$files = glob($dir.'/*.*');
	if ( !empty($files) ) {
		foreach ($files as $file) {
			unlink($file);
		}
	}
	rmdir($dir); 
}
?>
<div id="pluginsHelp" title="<? echo $lang_help; ?>">
<p>
<? echo $lang_pluginsHelpText; ?>
</p>
</div>
<a href="#" onclick="openHelp()"><? echo $lang_help; ?></a>
<div id="accordion">
	<h2><a href="#"><? echo $lang_pluginList; ?></a></h2>
	<div>
	<table id="pluginsTable">
		<thead>
			<td>ID</td>
			<td><? echo $lang_pluginName; ?></td>
			<td><? echo $lang_actions; ?></td>
		</thead>
	<?
	$verz = "plugins/";
	$dateien = scandir($verz);
	foreach($dateien as $t) {
		if($t != "." && $t != ".." && $t != "readme.txt"){
			$info = file("plugins/".$t."/info.txt");
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
					<button class="ui-state-default ui-corner-all right" onclick="deletePlugin('<? echo $t; ?>')"><? echo $lang_delete; ?></button>
				</td>
			</tr>
			<?
		}
	};
	?>
	</table>
	</div>

	<h2><a href="#"><? echo $lang_addPlugins; ?></a></h2>
	<div>
	<form id="fileUpload" method="post" action="?p=plugins&action=install-plugin" enctype="multipart/form-data">
		<label for="datei"><? echo $lang_pluginFile; ?>:</label>
		<input type="file" name="datei" id="datei" required="required" /><br><br>
		<button id="button" class="ui-state-default ui-corner-all" type="submit"><? echo $lang_upload; ?></button>
	</form>
	</div>
</div>
<?
} else {
	fehler($lang_noPermission);
}
?>