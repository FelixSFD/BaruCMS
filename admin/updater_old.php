<h1>Updater</h1>
<?
if($ECM["rights"]["UPDATE_SYSTEM"]){
	/*$update = file_get_contents('http://mdeil-voip.dyndns.org/ecm-activation/updateCheck.php?b='.$build."&v=".$version);
	if($update){
		echo $update;
	} else {
		fehler("Der Update-Server ist momentan nicht verfügbar!");
	}*/
	//copy("https://raw.github.com/FelixSFD/Baru-CMS/master/versionInfo.xml", "system/updater/updateInfo.xml");
	copy("http://familie-deil.de/versionInfo.xml", "system/updater/updateInfo.xml");
	if(file_exists("system/updater/updateInfo.xml")){
		$updateXML = simplexml_load_file("system/updater/updateInfo.xml");
		$newBuild = $updateXML->latestVersion->build;
		$newVersion = $updateXML->latestVersion->version;
		$newDate = $updateXML->latestVersion->build_date +0; //+0 bewirkt, dass der Server es als Zahl erkennt
		$newChangelog = $updateXML->latestVersion->changelog;
		if($newDate > $buildDate){
			hinweis('Es ist eine neue Version von Baru CMS verfügbar!');
			?>
			<center>
				<h2>Update Informationen</h2>
				<table border="1">
					<tr>
						<td>Aktuelle Version:</td>
						<td><? echo $version; ?></td>
					</tr>
					<tr>
						<td>Neue Version:</td>
						<td><? echo $newVersion." (".$newBuild.")"; ?></td>
					</tr>
					<tr>
						<td>Verfügbar seit:</td>
						<td><? echo date("d.m.Y", $newDate); ?></td>
					</tr>
					<tr>
						<td>Changelog:</td>
						<td><? echo base64_decode($newChangelog); ?></td>
					</tr>
				</table>
				<br><br>
				<script>
				function updateBaru(){
					$("#updateLoader").html("Update wird heruntergeladen...");
					$("#updateLoader").load("system/updater/downloadUpdate.php");
				}
				</script>
				<div id="updateLoader">
					<button class="custom" onclick="updateBaru()">Update runterladen!</button>
				</div>
			</center>
			<br><br>
			<?
		} else {
			hinweis("You have the latest version of Baru CMS!");
		}
	} else {
		fehler("Update-Informationen konnten nicht geladen werden!");
	}
} else {
	fehler($lang_noPermission);
}
?>