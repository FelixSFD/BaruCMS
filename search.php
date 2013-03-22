<?php
include "db_config.php";
$mysql = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name, $mysql);
echo '<div id="searchResults">';
$i = 0;
$query = $_GET["q"];
$search = mysql_query("SELECT * FROM ".$db_prefix."Pages WHERE Titel LIKE '%".$query."%' OR Inhalt LIKE '%".$query."%'", $mysql);
while($r = mysql_fetch_array($search)){
	$i++;
	echo '
		<div id="result'.$i.'" class="search-result vorschau">
			<h3 class="pointer" onclick="link(\''.$r["url"].'.html\')">'.$r["Titel"].'</h3>
			<p>'.substr(strip_tags($r["Inhalt"]), 0,250).'</p>
		</div>
	';
}
echo "<br>Die Suche lieferte $i Ergebnisse";
echo '</div>';
?>