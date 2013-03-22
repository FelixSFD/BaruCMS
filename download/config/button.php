<?
include "../../db_config.php";
$mysql = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name, $mysql);

$file_abfrage = mysql_query("SELECT * FROM Files WHERE ID = ".$_GET["id"], $mysql);
$file = mysql_fetch_array($file_abfrage);
echo mysql_error();
?>
<script>
function download(file){
	window.open("download/"+file);
}
</script>
<button class="ui-state-default ui-corner-all" onclick="download('<? echo $file["Code"]."_".$file["Name"] ?>')">
	DOWNLOAD<br>
	<small>(<? echo $file["Name"] ?>)</small>
</button>