<?php
include $_SERVER["DOCUMENT_ROOT"].dirname($_SERVER["SCRIPT_NAME"])."/db_config.php";
$mysql = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name, $mysql);


//API
function fehler($fehlermsg){
	echo "<div class='error'><h2><center>".$fehlermsg."</h2></center></div>";
}

function hinweis($hinweismsg){
	echo "<div class='highlight'><h2><center>".$hinweismsg."</h2></center></div>";
}

$module = strtolower($_GET['module']);
if(empty($module)) {
	$module = 'pages';
}

function ModuleExists($module) {
	if(file_exists('./backendModules/'.$module.'/main.css') && file_exists('./backendModules/'.$module.'/init.php')) {
			return true;
		} else {
			return false;
		}
}

function ActiveMenu($menuEntry) {
	global $module;
	if($menuEntry == $module) {
		return 'active';
	}
}


function getSetting($settingName){
	include $_SERVER["DOCUMENT_ROOT"].dirname($_SERVER["SCRIPT_NAME"])."/db_config.php";
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
	include $_SERVER["DOCUMENT_ROOT"].dirname($_SERVER["SCRIPT_NAME"])."/db_config.php";
	$mysql = mysql_connect($db_host, $db_user, $db_pass);
	mysql_select_db($db_name, $mysql);
	mysql_query("UPDATE `".$db_prefix."Settings` SET `Value` = '".$newValue."' WHERE Name = '".$settingName."'", $mysql);
	if(mysql_error()){
		return false;
	} else {
		return true;
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

function getRights($name, $group){
	include $_SERVER["DOCUMENT_ROOT"].dirname($_SERVER["SCRIPT_NAME"])."/db_config.php";
	$mysql = mysql_connect($db_host, $db_user, $db_pass);
	mysql_select_db($db_name, $mysql);
	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = '".$name."'", $mysql);
	echo mysql_error();
	$rightsOK = false;
	while($cR = mysql_fetch_array($cRights)){
		if($cR["Group"] == $group){
			$rightsOK = true;
		}
	}
	return $rightsOK;
}

if($_POST["action"] == "login"){
	$login_abfrage = mysql_query("SELECT * FROM ".$db_prefix."User WHERE Email = '".$_POST["email"]."'", $mysql);
	$usrs = mysql_fetch_array($login_abfrage);
	if(md5($_POST["pw"]) == $usrs["Passwort"] && $usrs["Status"] == "1"){	
		$session_length = 60*60*24*7;
		$session_expires = time()+$session_length;
		$session_id = zufallsstring(32);
		mysql_query("INSERT INTO `".$db_prefix."Session` VALUES ('".$usrs["ID"]."', '".$session_id."', '".$_SERVER["REMOTE_ADDR"]."','".$session_expires."')", $mysql);
		//echo mysql_error();
		setcookie("login_id", $session_id, time()+$session_length, "/");
		#hinweis("Login erfolgreich!");
		$justloggedin = true;
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


$configXML = simplexml_load_file("../system/config.xml");

//Version----------------------------------------------------------------------------------------------------------------
$version = $configXML->version_info->version;
$build = $configXML->version_info->build;
$buildDate = $configXML->version_info->build_date;
$appName = $configXML->version_info->app_name;
$appID = $configXML->version_info->app_id;
$baruBranding = $configXML->version_info->app_branding;
?>