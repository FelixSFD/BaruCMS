<?
include "../db_config.php";
$mysql = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name, $mysql);

$file_abfrage = mysql_query("SELECT * FROM Files WHERE ID = ".$_GET["file"], $mysql);
$file = mysql_fetch_array($file_abfrage);
echo mysql_error();
?>
<video width="<? echo $_GET["w"]; ?>" height="<? echo $_GET["h"]; ?>" controls="controls">
  <source src="download/<? echo $file["Code"]."_".$file["Name"] ?>" type="<? echo $file["Typ"] ?>" />
  <a href="download/<? echo $file["Code"]."_".$file["Name"] ?>">DOWNLOAD</a>
</video>