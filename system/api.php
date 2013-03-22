<?php
function getSetting($settingName){
	include "db_config.php";
	$mysql = mysql_connect($db_host, $db_user, $db_pass);
	mysql_select_db($db_name, $mysql);
	$settings = mysql_query("SELECT * FROM ".$db_prefix."Settings WHERE Name = '".$settingName."'", $mysql);
	if(mysql_error()){
		return false;
	}
	$s = mysql_fetch_array($settings);
	return $s["Value"];
}

function setSetting($settingName, $newValue){
	include "db_config.php";
	$mysql = mysql_connect($db_host, $db_user, $db_pass);
	mysql_select_db($db_name, $mysql);
	mysql_query("UPDATE `".$db_prefix."Settings` SET `Value` = '".$newValue."' WHERE Name = '".$settingName."'", $mysql);
	if(mysql_error()){
		return false;
	} else {
		return true;
	}
}

function user_FB($userID){
	include "db_config.php";
	$mysql = mysql_connect($db_host, $db_user, $db_pass);
	mysql_select_db($db_name, $mysql);
	$settings = mysql_query("SELECT * FROM ".$db_prefix."User WHERE ID = '".$userID."'", $mysql);
	if(mysql_error()){
		return false;
	}
	$s = mysql_fetch_array($settings);
	if($s["FacebookID"] && $s["FacebookID"] != "0"){
		return true;
	} else {
		return false;
	}
}


function fehler($fehlermsg){
	echo "<div class='ui-state-error'><h2><center>".$fehlermsg."</h2></center></div>";
}

function hinweis($hinweismsg){
	echo "<div class='ui-state-highlight'><h2><center>".$hinweismsg."</h2></center></div>";
}


function sonderzeichen($text){
	$text = str_replace ("ä", "ae", $text);
	$text = str_replace ("ö", "oe", $text);
	$text = str_replace ("ü", "ue", $text);
	$text = str_replace ("ß", "ss", $text);
	$text = str_replace (" ", "_", $text);
	return $text;
}

function zufallsstring($laenge=16){
	//Zeichen, die im Zufallsstring vorkommen sollen
	$zeichen = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$zufalls_string = '';
	$anzahl_zeichen = strlen($zeichen);
	for($i=0;$i<$laenge;$i++){
		$zufalls_string .= $zeichen[mt_rand(0, $anzahl_zeichen - 1)];
	}
	return $zufalls_string;
}

function zufallszahl($laenge=16){
	//Zeichen, die im Zufallsstring vorkommen sollen
	$zeichen = '1234567890';
	$zufalls_string = '';
	$anzahl_zeichen = strlen($zeichen);
	for($i=0;$i<$laenge;$i++){
		$zufalls_string .= $zeichen[mt_rand(0, $anzahl_zeichen - 1)];
	}
	return $zufalls_string;
}

function strtoURL($eingabe)
{
	$ausgabe = strtolower($eingabe);

	//Satzzeichen entfernen
	$ausgabe = str_replace(" ", "-", $ausgabe);
	$ausgabe = str_replace("_", "-", $ausgabe);
	$ausgabe = str_replace(",", "", $ausgabe);
	$ausgabe = str_replace(".", "", $ausgabe);
	$ausgabe = str_replace(":", "", $ausgabe);
	$ausgabe = str_replace("!", "", $ausgabe);
	$ausgabe = str_replace("?", "", $ausgabe);
	$ausgabe = str_replace("=", "", $ausgabe);
	$ausgabe = str_replace("'", "", $ausgabe);
	$ausgabe = str_replace('"', '', $ausgabe);
	$ausgabe = str_replace("^", "", $ausgabe);
	$ausgabe = str_replace("´", "", $ausgabe);
	$ausgabe = str_replace("`", "", $ausgabe);
	$ausgabe = str_replace("#", "", $ausgabe);
	$ausgabe = str_replace("+", "", $ausgabe);

	//Spezielle buchstaben entfernen
	$ausgabe = str_replace("Ä", "ae", $ausgabe);
	$ausgabe = str_replace("ä", "ae", $ausgabe);
	$ausgabe = str_replace("Ö", "oe", $ausgabe);
	$ausgabe = str_replace("ö", "oe", $ausgabe);
	$ausgabe = str_replace("Ü", "ue", $ausgabe);
	$ausgabe = str_replace("ü", "ue", $ausgabe);
	$ausgabe = str_replace("ß", "ss", $ausgabe);
	
	return zufallszahl(4)."-".$ausgabe;
}
?>