<?php
if(getRights("UPDATE_SYSTEM", $userinfo["Group"])){
?>
<div class="contentHead">
<h1>Updates</h1>
<?php
$update = file_get_contents('http://update.barucms.bplaced.de/check.php?lang=DE&b='.$build."&v=".$version."&a=".$appID."&host=".urlencode($_SERVER["SERVER_NAME"]));
if($update){
	echo $update;
} else {
	fehler("Der Update-Server ist momentan nicht verfügbar!");
}
} else {
	echo errorcode(403, true);
}
?>