<?
include "../system/api.php";
if($_GET["action"] == "upload"){
	$faviconPath = "../img/favicons/favicon_".zufallsstring(8).".png";
	move_uploaded_file($_FILES['favicon']['tmp_name'], $faviconPath);
	if(file_exists($faviconPath)){
		hinweis("Upload erfolgreich!");
	} else {
		fehler("Es ist ein unbekannter Fehler aufgetreten!");
	}
	?>
	<script>
	function closeWindow(){
		window.close();
	}
	setTimeout(closeWindow, 2000);
	</script>
	<?
} else {
	?>
	<center>
	<form id="fileUpload" method="post" action="?action=upload" enctype="multipart/form-data">
		<label for="favicon"><b>Favicon auswählen:</b><br></label><input type="file" name="favicon" id="favicon" required="required" />
		<br>
		<button>Upload</button>
	</form>
	</center>
	<?
}
?>