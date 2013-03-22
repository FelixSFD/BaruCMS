<h1>Updater</h1>
<?
if($ECM["rights"]["UPDATE_SYSTEM"]){
	$update = file_get_contents('http://mdeil-voip.dyndns.org/baru-update/check.php?lang=DE&b='.$build."&v=".$version."&a=".$appID);
	if($update){
		echo $update;
	} else {
		fehler("Der Update-Server ist momentan nicht verfügbar!");
	}
} else {
	fehler($lang_noPermission);
}
?>