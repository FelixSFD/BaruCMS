<?
//ALTER TABLE `User` ADD `Group` INT NOT NULL AFTER `Passwort` 
error_reporting (E_ALL && ~E_NOTICE);
#error_reporting (0);
$ladezeitStart = microtime(true);
session_start();

if(file_exists("setup.php")){
	header("Location: setup.php");
}
include "db_config.php";
$mysql = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name, $mysql);

include "system/api.php";
$configXML = simplexml_load_file("system/config.xml");


//Login
if($_GET["login"] && $_POST["email"] && $_POST["pw"]){
	$login_abfrage = mysql_query("SELECT * FROM ".$db_prefix."User WHERE Email = '".$_POST["email"]."'", $mysql);
	$usrs = mysql_fetch_array($login_abfrage);
	if(md5($_POST["pw"]) == $usrs["Passwort"] && $usrs["Status"] == "1"){	
		$session_length = 60*60*24*7;
		$session_expires = time()+$session_length;
		$session_id = zufallsstring(32);
		mysql_query("INSERT INTO `".$db_prefix."Session` VALUES ('".$usrs["ID"]."', '".$session_id."', '".$_SERVER["REMOTE_ADDR"]."','".$session_expires."')", $mysql);
		//echo mysql_error();
		setcookie("ECM_id", $session_id, time()+$session_length, "/");
		hinweis("Login erfolgreich!");
		$justloggedin = true;
	} else if($usrs["Status"] != "1"){
		fehler($lang_loginNotActivated); 
	} else {
		fehler($lang_loginFailed);
	}
	exit;
}

if(mysql_error()){
	$schwererFehler = "1";
	exit;
}

//Login-Check
$logincheck = mysql_query("SELECT * FROM ".$db_prefix."Session WHERE Session = '".$_COOKIE["ECM_id"]."'", $mysql);
if(mysql_error()){
	fehler(mysql_error());
	exit;
}
$lCheck = mysql_fetch_array($logincheck);
if($lCheck["Expires"] > time()){
	$ECM["login_ok"] = "1";
	$baru["login_ok"] = true;
	$ECM["userID"] = $lCheck["User"]; 
	$baru["userID"] = $lCheck["User"]; 
	setcookie("ECM_id", $_COOKIE["ECM_id"], time()+60*60*24*7, "/");
}

if($ECM["login_ok"] == "1" or $justloggedin){
	//User-Info
	$userinfos = mysql_query("SELECT * FROM ".$db_prefix."User WHERE ID = ".$ECM["userID"], $mysql);
	echo mysql_error();
	$userinfo = mysql_fetch_array($userinfos);
	$ECM["userGroup"] = $userinfo["Group"]; 


	//Rechte prüfen
	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_USER'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["ADD_USER"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_USER'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["EDIT_USER"] = true;
		}
	}
	
	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_USER_PW'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["EDIT_USER_PW"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'DELETE_USER'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["DELETE_USER"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'MANAGE_GROUPS'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["MANAGE_GROUPS"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_PAGE'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["ADD_PAGE"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_PAGE'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["EDIT_PAGE"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'DELETE_PAGE'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["DELETE_PAGE"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_FILE'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["ADD_FILE"] = true;
		}
	}
	
	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_FOLDER'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["ADD_FOLDER"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'DELETE_FILE'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["DELETE_FILE"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_STYLE'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["EDIT_STYLE"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_GENERAL_SETTINGS'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["EDIT_GENERAL_SETTINGS"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'UPDATE_SYSTEM'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["UPDATE_SYSTEM"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'VIEW_SYSTEM_INFO'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["VIEW_SYSTEM_INFO"] = true;
		}
	}
	
	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'MANAGE_PLUGINS'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["MANAGE_PLUGINS"] = true;
		}
	}
	
	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'MANAGE_TEMPLATES'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["MANAGE_TEMPLATES"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_MENU'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["ADD_MENU"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_MENU'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["EDIT_MENU"] = true;
		}
	}

	$cRights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'DELETE_MENU'", $mysql);
	echo mysql_error();
	while($cR = mysql_fetch_array($cRights)){
		if($cR["GroupID"] == $ECM["userGroup"]){
			$ECM["rights"]["DELETE_MENU"] = true;
		}
	}
}


$timestamp = time();
$datetimepicker = date("d/m/Y H:i", $timestamp);

//Version----------------------------------------------------------------------------------------------------------------
$version = $configXML->version_info->version;
$build = $configXML->version_info->build;
$buildDate = $configXML->version_info->build_date;
$appName = $configXML->version_info->app_name;
$appID = $configXML->version_info->app_id;
$baruBranding = $configXML->version_info->app_branding;
//-----------------------------------------------------------------------------------------------------------------------
$activationURL = "http://mdeil-voip.dyndns.org/baru-server/";

//$helloText = file("admin/settings/HelloText.txt"); Bereits in DB
$licenseCode = file("system/license.txt");
$favicon = file("admin/settings/favicon.txt");
$jQtheme = file("admin/settings/jQueryTheme.txt");
//$set = file("admin/settings/settings.txt"); Bereits in DB
$setMenu = file("admin/settings/menu.txt");
$setStyle = file("admin/settings/style.txt");
$setStyleHeader = file("admin/settings/header.txt");
//$wartung = file("admin/settings/wartung.txt"); Bereits in DB

//Sprache---------------------------------------------------------------------------------------------------------------
include "languages/".getSetting("LANGUAGE").".php";
//----------------------------------------------------------------------------------------------------------------------

include "browser.php";

//Plugins HEAD.php
/*
if(substr($_SERVER["SCRIPT_FILENAME"], -9) == "index.php"){
	$verz = "plugins/";
	$dateien = scandir($verz);
	foreach($dateien as $t) {
		if($t != "." && $t != ".."){
			include "plugins/".$t."/head.php";
		}
	}
}*/


function picSize($treffer){
		// falls keine gültige Adresse angegeben wurde, wird die Fehlermeldung unterdrückt
		$size = @getimagesize($treffer[1]);
	if($size[0] > 400) {
		$width = 400;
		// Höhe berechnen
		$height = ($size[1]/$size[0])*$width;
		return " <a href='".$treffer[1]."' class='lightbox'><img src=\"".$treffer[1]."\" width=\"".$width."\" height=\"".$height."\" border=\"0\"></a>";
	} else {
		return " <a href='".$treffer[1]."' class='lightbox'><img src=\"".$treffer[1]."\" border=\"0\"></a>";
	}
}

function bbCodeIMG($bb){
	$html = preg_replace_callback("/\[img\](.*)\[\/img\]/Usi", 'picSize', $bb);
	return $html;
}

function bbCodeYT($bb){
	$html = str_replace('[yt]', '<center><iframe width="640" height="360" src="https://www.youtube.com/embed/', $bb);
	$html = str_replace('[/yt]', '" frameborder="0" allowfullscreen></iframe></center>', $html);
	/*$YTid = str_replace('[yt]', '', $bb);
	$YTid = str_replace('[/yt]', '', $YTid);
	$result = '<center class="youtube">';
	$result .= '<iframe width="640" height="360" src="https://www.youtube.com/embed/'.$YTid.'" frameborder="0" allowfullscreen></iframe>';
	$result .= '</center>';*/
	
	//$html = str_replace($YTid, $result, $bb);
	
	return $html;
}

function autolink($str, $attributes=array()) {
  $attrs = '';
  foreach ($attributes as $attribute => $value) {
    $attrs .= " {$attribute}=\"{$value}\"";
  }
$str = ' ' . $str;
$str = preg_replace(
  '`([^"=\'>])(((http|https|ftp)://|www.)[^\s<]+[^\s<\.)])`i',
  '<a href="go.php?url=http://$2"'.$attrs.'>$2</a>',
  $str
);
$str = substr($str, 1);
$str = preg_replace('`href=\"www`','href="http://www',$str);

// fügt http:// hinzu, wenn nicht vorhanden
return $str;
}
?>
<!-- jQuery -->
<?php
$themeInfo = file("system/jQuery/css/".$jQtheme[0]."/info.txt");
$themeFile = $themeInfo[1];
?>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />

<link type="text/css" href="system/jQuery/css/<? echo $jQtheme[0]; ?>/<? echo $themeFile; ?>" rel="Stylesheet">
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
</style>
<script type="text/javascript" src="/cms/system/jQuery/plugins/tables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="system/timepicker.js"></script>


<!-- Menü -->
<script type='text/javascript' src='system/jQuery/plugins/jquery-mega-drop-down-menu/js/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='system/jQuery/plugins/jquery-mega-drop-down-menu/js/jquery.dcmegamenu.1.3.3.js'></script>

<!--<script type="text/javascript" src="system/jQuery/plugins/jquery-mega-drop-down-menu/js/hoverIntent.js"></script>
<script type="text/javascript" src="system/jQuery/plugins/jquery-mega-drop-down-menu/js/jquery-1.2.6.min.js"></script>-->
<link href="system/jQuery/plugins/jquery-mega-drop-down-menu/css/skins/black.css" rel="stylesheet" type="text/css" />
<link href="system/jQuery/plugins/jquery-mega-drop-down-menu/css/skins/grey.css" rel="stylesheet" type="text/css" />
<link href="system/jQuery/plugins/jquery-mega-drop-down-menu/css/skins/blue.css" rel="stylesheet" type="text/css" />
<link href="system/jQuery/plugins/jquery-mega-drop-down-menu/css/skins/green.css" rel="stylesheet" type="text/css" />
<link href="system/jQuery/plugins/jquery-mega-drop-down-menu/css/skins/light_blue.css" rel="stylesheet" type="text/css" />
<link href="system/jQuery/plugins/jquery-mega-drop-down-menu/css/skins/orange.css" rel="stylesheet" type="text/css" />
<link href="system/jQuery/plugins/jquery-mega-drop-down-menu/css/skins/red.css" rel="stylesheet" type="text/css" />
<link href="system/jQuery/plugins/jquery-mega-drop-down-menu/css/skins/white.css" rel="stylesheet" type="text/css" />

<!-- Menü ENDE -->

<!-- Lightbox: http://leandrovieira.com/projects/jquery/lightbox/ -->
<script src="system/jQuery/plugins/lightbox/js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="system/jQuery/plugins/lightbox/css/jquery.lightbox-0.5.css" media="screen" />

<!-- prettyCheckboxes: -->
<script src="system/jQuery/plugins/prettyCheckboxes/js/prettyCheckboxes.js" type="text/javascript" charset="utf-8"></script>

<!-- Socialshareprivacy -->
<script type="text/javascript" src="system/jQuery/plugins/socialshareprivacy/jquery.socialshareprivacy.js"></script>

<!-- ajaxForms by Felix Deil -->
<script type="text/javascript" src="system/jQuery/plugins/ajaxForms/js/ajaxForms.js"></script>


<!-- tinyMCE -->
<?php
include "system/tinymce.php";
// tinyMCE ENDE

?>
<!-- Facebook JavaScript SDK -->
<?php
include_once "system/facebook/jsAPI.php";

if(file_exists("system/styles/userDefinied.css") && substr($_SERVER["PHP_SELF"], -9) != "admin.php"){
	?>
	<link href="system/styles/userDefinied.css" rel="stylesheet" type="text/css" />
	<?php
}

?>
<script>
$(document).ready(function() { 
		var video = $("#video").data("id");
		var videoWidth = $("#video").data("width");
		var videoHeight = $("#video").data("height");
		/*$(document).tooltip({
			track: true
		});*/
		$("#video").load("videoPlayer/player1.php?file="+video+"&w="+videoWidth+"&h="+videoHeight);
        $("#error").addClass("ui-state-error ui-corner-all");
		$("#hinweis").addClass("ui-state-highlight ui-corner-all");
		$("#uploaderDialog").dialog({
			autoOpen: false,
			modal: true
		});
		$("#uploaderDialog1").dialog({autoOpen: false});
		$("#uploaderDialog2").dialog({autoOpen: false});
		$("#deleteDialog").dialog({
			autoOpen: false,
			modal: true,
			width: 500,
			height: 300
		});
		$("#loginDialog").dialog({
			autoOpen: false,
			modal: true,
			width: 500,
			height: 300,
			buttons: {
				"<? echo $lang_login; ?>": function (){
					$("#loginForm").submit();
					$(this).dialog("close");
				}
			}
		});
		
		$("#loginForm").ajaxForms();
		
		
		$("#tabs").tabs();
		$("#accordion").accordion({
			autoHeight: false,
			navigation: true
		});
		$("#einbetten").dialog({
			autoOpen: false,
			modal: true
		});
		$("#einbettenIMG").dialog({
			autoOpen: false,
			modal: true
		});
		$("#einbettenV").dialog({
			autoOpen: false,
			modal: true
		});
		$("#pluginsHelp").dialog({
			autoOpen: false,
			width: 600,
			modal: true
		});
		$("#templatesHelp").dialog({
			autoOpen: false,
			width: 600,
			modal: true
		});
		$("#newFolderDialog").dialog({
			autoOpen: false,
			modal: true
		});
		<?php
		if(!$html5){
			?>
			$("#oldBrowser").dialog({modal: true});
			<?php
		}
		?>
		$('#mega-menu-1').dcMegaMenu({
			rowItems: '<?php echo $setMenu[2]; ?>',
			speed: <?php echo str_replace("\n", "", $setMenu[1]); ?>,
			effect: 'slide',
			event: 'hover',
			fullWidth: true
		});
		$('#mega-menu-2').dcMegaMenu({
			rowItems: '5',
			speed: 1,
			effect: 'slide',
			event: 'hover',
			fullWidth: true
		});
		$("#date").datetimepicker({
			minDate: 0,
			hourGrid: 4,
			minuteGrid: 10,
			dateFormat: $.timepicker.TIMESTAMP
		});
		
		oTable = $('#userList').dataTable({
		"sScrollY": 190,
        "bJQueryUI": true,
		"bAutoWidth": true,
		"bStateSave": true,
        "sPaginationType": "full_numbers"
		});
		oTable2 = $('#pagesList').dataTable({
		"sScrollY": 190,
        "bJQueryUI": true,
		"bAutoWidth": true,
		"bStateSave": true,
        "sPaginationType": "full_numbers"
		});
		oTable3 = $('#menuList').dataTable({
		"sScrollY": 190,
        "bJQueryUI": true,
		"bAutoWidth": true,
		"bStateSave": true,
        "sPaginationType": "full_numbers"
		});
		oTable4 = $('#filesList').dataTable({
		"sScrollY": 500,
        "bJQueryUI": true,
		"bAutoWidth": true,
		"bStateSave": true,
        "sPaginationType": "full_numbers"
		});
		oTable5 = $('#groupsList').dataTable({
		"sScrollY": 190,
        "bJQueryUI": true,
		"bAutoWidth": true,
		"bStateSave": true,
        "sPaginationType": "full_numbers"
		});
		oTable6 = $('#pluginsTable').dataTable({
		"sScrollY": 190,
        "bJQueryUI": true,
		"bAutoWidth": true,
		"bStateSave": true,
        "sPaginationType": "full_numbers"
		});
		$('#socialshareprivacy').socialSharePrivacy();
		$('input[type=checkbox],input[type=radio]').prettyCheckboxes();
		dlButtons();
		//imgPreviews();
		$('.lightbox').lightBox({
			imageLoading: 'system/jQuery/plugins/lightbox/images/loading.gif',
			imageBtnClose: 'system/jQuery/plugins/lightbox/images/close.gif',
			imageBtnPrev: 'system/jQuery/plugins/lightbox/images/prev.gif',
			imageBtnNext: 'system/jQuery/plugins/lightbox/images/next.gif'
		});
		
		
		$(".ui-dialog-buttonset button").removeAttr("role");
		$(".ui-dialog-buttonset button").attr("onmouseover", "$('.ui-dialog-buttonset button').removeClass();");
		$(".ui-dialog-buttonset button").removeClass();
		$(".ui-dialog-buttonset button").addClass("custom");
		
		$(".checkbox").buttonset();
		
		$("#menu").baruMenu();
    });
</script>
<script type="text/javascript" src="system/all.js"></script>
<style>
/* css for timepicker */
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }



#userList tr:hover, #filesList tr:hover{
	background-color: #ECFFB3;
}

.ex_highlight #userList tbody tr.even:hover, #userList tbody tr.even td.highlighted {
	background-color: #ECFFB3;
}

.ex_highlight #userList tbody tr.odd:hover, #userList tbody tr.odd td.highlighted {
	background-color: #E6FF99;
}

.ex_highlight_row #userList tr.even:hover {
	background-color: #ECFFB3;
}

.ex_highlight_row #userList tr.even:hover td.sorting_1 {
	background-color: #DDFF75;
}

.ex_highlight_row #userList tr.even:hover td.sorting_2 {
	background-color: #E7FF9E;
}

.ex_highlight_row #userList tr.even:hover td.sorting_3 {
	background-color: #E2FF89;
}

.ex_highlight_row #userList tr.odd:hover {
	background-color: #E6FF99;
}

.ex_highlight_row #userList tr.odd:hover td.sorting_1 {
	background-color: #D6FF5C;
}

.ex_highlight_row #userList tr.odd:hover td.sorting_2 {
	background-color: #E0FF84;
}

.ex_highlight_row #userList tr.odd:hover td.sorting_3 {
	background-color: #DBFF70;
}




button.custom{
	background: -webkit-linear-gradient(#bbe52b 0%, #98c413 100%);
	background: -moz-linear-gradient(#bbe52b 0%, #98c413 100%);
	border: 1px solid #8ab30b;
	border-radius: 5px;
	color: #ffffff;
	padding: 7px;
	font-size: 9pt;
	text-shadow: 0 -1px 0 #85a710;
	box-shadow: 0 1px 4px rgba(0,0,0,0.25), inset 0 1px 0 #ceec37;
}

button.custom:hover{
	background: -webkit-linear-gradient(#9ec224 0%, #83a812 100%);
	background: -moz-linear-gradient(#9ec224 0%, #83a812 100%);
	box-shadow: 0 1px 4px rgba(0,0,0,0.25);
	cursor: pointer;
}

button.custom:active{
	box-shadow: none;
}
</style>
<?php
if($ECM["rights"]["UPDATE_SYSTEM"] && getSetting("WARTUNG") == "1"){
	$wartung2 = true;
} else {
	$wartung2 = false;
}

if(getSetting("WARTUNG") == "1" && substr($_SERVER["SCRIPT_FILENAME"], -9) == "index.php" && $wartung2 == false){
	?>
	<style>
	html{
		<?php
		if($setStyle[1] == "1"){
			echo "background: url('img/bg.png')";
		} else {
			echo "background: #".$setStyle[0];
		}
		?>
	}
	</style>
	<?php
	fehler($lang_wartungsmodusAktiv1);
	exit;
}

if($schwererFehler == "1"){
	fehler($lang_bigError);
	exit;
}
?>