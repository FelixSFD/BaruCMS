<?
include "../../db_config.php";
$mysql = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name, $mysql);

$file_abfrage = mysql_query("SELECT * FROM Files WHERE ID = ".$_GET["id"], $mysql);
$file = mysql_fetch_array($file_abfrage);
echo mysql_error();
?>
<!--
<a href="download/<? echo $file["Code"]."_".$file["Name"] ?>" class="lightbox" title="<? echo $file["Name"] ?>">
	<img src="download/<? echo $file["Code"]."_".$file["Name"] ?>" width="250px" />
</a>-->
<a href="system/jQuery/plugins/lightbox/photos/image1.jpg" width="72" height="72" class="lightbox">
	<img src="system/jQuery/plugins/lightbox/photos/thumb_image1.jpg" />
</a>