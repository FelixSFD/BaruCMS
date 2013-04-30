<?php
$documentRoot = $_SERVER["DOCUMENT_ROOT"];
global $rootPath;
if(file_exists($documentRoot.dirname($_SERVER["SCRIPT_NAME"])."/db_config.php")){
	$rootPath = $documentRoot.dirname($_SERVER["SCRIPT_NAME"]);
} else if(file_exists(getcwd()."/../db_config.php")){
	$rootPath = getcwd()."/..";
} else if(file_exists(getcwd()."/../../db_config.php")){
	$rootPath = getcwd()."/../..";
} else if(file_exists(getcwd()."/../../../db_config.php")){
	$rootPath = getcwd()."/../../..";
} else if(file_exists(getcwd()."/../../../../db_config.php")){
	$rootPath = getcwd()."/../../../..";
}
#echo $rootPath;
include $rootPath."/db_config.php";
include $rootPath."/system/mysqli_connect.php";
$mysql = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name, $mysql);

//API
function fehler($fehlermsg){
	#echo "<div class='error'><h2><center>".$fehlermsg."</h2></center></div>";
	echo errorcode($fehlermsg);
}
function errorcode($code, $link = false){
	global $rootPath;
	$pathToError = $rootPath."/system/errors/".$code.".php";
	if(file_exists($pathToError)){
		include $pathToError;
	} else {
		echo "Unbekannter Fehler!";
	}
	
	if($link){
		return '<h3><a href="javascript:history.back();">Zur&uuml;ck &raquo;</a></h3>';
	}
}

function hinweis($hinweismsg){
	echo "<div class='highlight'><h2><center>".$hinweismsg."</h2></center></div>";
}

$module = strtolower($_GET['module']);
if(empty($module)) {
	$module = 'pages';
}

function ModuleExists($module) {
	global $rootPath;
	if(file_exists($rootPath.'/backend/backendModules/'.$module.'.baru/main.css') && file_exists($rootPath.'/backend/backendModules/'.$module.'.baru/init.php')) {
			return true;
		} else {
			return false;
		}
}

function ActiveMenu($menuEntry) {
	global $module;
	if($menuEntry == $module.".baru") {
		return 'active';
	}
}


function getSetting($settingName){
	global $rootPath;
	include $rootPath."/db_config.php";
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
	global $rootPath;
	include $rootPath."/db_config.php";
	$mysql = mysql_connect($db_host, $db_user, $db_pass);
	mysql_select_db($db_name, $mysql);
	mysql_query("UPDATE `".$db_prefix."Settings` SET `Value` = '".$newValue."' WHERE Name = '".$settingName."'", $mysql);
	if(mysql_error()){
		return false;
	} else {
		return true;
	}
}

function setRights($name, $value, $group){
	global $rootPath;
	include $rootPath."/db_config.php";
	include $rootPath."/system/mysqli_connect.php";
	$result;
	if($name){
		if($value){
			$rightsQuery = $db->query("SELECT * FROM ".$db_prefix."Rights WHERE Name = '".$name."' AND GroupID = '".$group."'");
			$result .= mysqli_error($db);
			$rightsResult = $rightsQuery->fetch_object();
			if($rightsResult->ID){
				$result .= "Bereits vorhanden<br>";
			} else {
				$db->query("INSERT INTO `".$db_prefix."Rights` VALUES ('', '".$name."', '".$group."')");
				$result .= "Erstellen...<br>";
			}
			
			$result .= mysqli_error($db);
		} else {
			$db->query("DELETE FROM `".$db_prefix."Rights` WHERE Name = '".$name."' AND GroupID = '".$group."'");
			$result .= "deleted<br>";
		}
	} else {
		$result .= "Kein Name<br>";
	}
	#return $result;
}

function getRights($name, $group){
	global $rootPath;
	include $rootPath."/db_config.php";
	include $rootPath."/system/mysqli_connect.php";
	$rightsQuery = $db->query("SELECT * FROM ".$db_prefix."Rights WHERE Name = '".$name."' AND GroupID = '".$group."'");
	$rightsResult = $rightsQuery->fetch_object();
	if($rightsResult->ID){
		return true;
	} else {
		return false;
	}
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

/*
function help($text){
	if(getSetting("SHOW_HELP")){
		return 'title="'.$text.'"';
	} else {
		return false;
	}
}*/


if($_POST["action"] == "login" && $_GET["action"] != "logout"){
	$login_abfrage = mysql_query("SELECT * FROM ".$db_prefix."User WHERE Email = '".$_POST["email"]."'", $mysql);
	$usrs = mysql_fetch_array($login_abfrage);
	
	include_once $rootPath."/system/classes/baruPassword.class.php";
	$pw = new baruPassword;
	$hashedPassword = $pw->hashPassword($_POST["email"], $_POST["pw"]);
	if($hashedPassword == $usrs["Passwort"] && $usrs["Status"] == "1"){	
		$session_length = 60*60*24*7;
		$session_expires = time()+$session_length;
		$session_id = zufallsstring(32);
		mysql_query("INSERT INTO `".$db_prefix."Session` VALUES ('".$usrs["ID"]."', '".$session_id."', '".$_SERVER["REMOTE_ADDR"]."','".$session_expires."')", $mysql);
		//echo mysql_error();
		setcookie("login_id", $session_id, time()+$session_length, "/");
		#hinweis("Login erfolgreich!");
		$justloggedin = true;
		header("Location: backend.php");
	} else if($usrs["Status"] != "1"){
		#fehler("User nicht aktiviert!"); 
		$loginerror = "User nicht aktiviert!";
	} else {
		#fehler("Benutzername und/oder Passwort falsch!");
		$loginerror = "Benutzername und/oder Passwort falsch!";
	}
	#exit;
}

//Logincheck
$logincheck = mysql_query("SELECT * FROM ".$db_prefix."Session WHERE Session = '".$_COOKIE["login_id"]."'", $mysql);
if(mysql_error()){
	fehler(mysql_error());
	exit;
}
$lCheck = mysql_fetch_array($logincheck);
if($lCheck["Expires"] > time()){
	$baru["login_ok"] = true;
	$baru["userID"] = $lCheck["User"]; 
	setcookie("login_id", $_COOKIE["login_id"], time()+60*60*24*7, "/");

	//User-Info
	$userinfos = mysql_query("SELECT * FROM ".$db_prefix."User WHERE ID = ".$baru["userID"], $mysql);
	echo mysql_error();
	$userinfo = mysql_fetch_array($userinfos);
}


$configXML = simplexml_load_file($rootPath."/system/config.xml");

//Version----------------------------------------------------------------------------------------------------------------
$version = $configXML->version_info->version;
$build = $configXML->version_info->build;
$buildDate = $configXML->version_info->build_date;
$appName = $configXML->version_info->app_name;
$appID = $configXML->version_info->app_id;
$baruBranding = $configXML->version_info->app_branding;
?>