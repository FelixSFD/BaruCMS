<?
include "config.php";

$login_abfrage = mysql_query("SELECT * FROM ".$db_prefix."User WHERE Email = '".$_POST["email"]."'", $mysql);
$usrs = mysql_fetch_array($login_abfrage);
if(md5($_POST["pw"]) == $usrs["Passwort"] && $usrs["Status"] == "1"){
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
	
	$session_length = 60*60*24*7;
	$session_expires = time()+$session_length;
	$session_id = zufallsstring(32);
	mysql_query("INSERT INTO `".$db_prefix."Session` VALUES ('".$usrs["ID"]."', '".$session_id."', '".$_SERVER["REMOTE_ADDR"]."','".$session_expires."')", $mysql);
	echo mysql_error();
	setcookie("ECM_id", $session_id, time()+$session_length, "/");
	echo "OK";
} else if($usrs["Status"] != "1"){
	echo $lang_loginNotActivated;
} else {
	echo $lang_loginFailed; 
}

#echo $_POST["email"];
?>