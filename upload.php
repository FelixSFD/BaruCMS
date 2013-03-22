<?
include "system/config.php";
if(!$_COOKIE["lang"]){
	include "languages/DE.php";
} else {
	include "languages/".$_COOKIE["lang"].".php";
}

if(!$_GET["action"]){
	?>
	<form id="fileUpload" method="post" action="upload.php?action=upload&target=<? echo $_GET["target"]; ?>" enctype="multipart/form-data">
		<input type="file" name="datei" /><br>
		<button id="button" class="ui-state-default ui-corner-all right" type="submit"><? echo $lang_uploadFile; ?></button>
	</form>
	<?
} else if($_GET["action"] == "upload"){
	move_uploaded_file($_FILES['datei']['tmp_name'], "img/".$_GET["target"].".png"); 
	hinweis($lang_fileUploaded);
} else {
	fehler("Unbekannter Fehler!");
}
?>