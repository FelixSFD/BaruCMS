<?
include_once "system/config.php";

if($_GET["menuFarbschema"]){
	$settingsStyle[0] = $_GET["menuFarbschema"]; 
	$handle_menuFarbschema = fopen("admin/settings/menu.txt", "w");
	fwrite($handle_menuFarbschema, implode('', $settingsStyle));
	$edited = true;
}

if($_GET["menuVerz"]){
	$settingsStyle[1] = "\n".$_GET["menuVerz"];
	$handle_menuVerz = fopen("admin/settings/menu.txt", "w");
	fwrite($handle_menuVerz, implode('', $settingsStyle));
	$edited = true;
}

if($_GET["menuKPR"]){
	$settingsStyle[2] = "\n".$_GET["menuKPR"];
	$handle_menuKPR = fopen("admin/settings/menu.txt", "w");
	fwrite($handle_menuKPR, implode('', $settingsStyle));
	$edited = true;
}


if($_GET["bgColor"]){
	$settingsStyle[0] = $_GET["bgColor"];
	$handle_bgColor = fopen("admin/settings/style.txt", "w");
	fwrite($handle_bgColor, implode('', $settingsStyle));
	$edited = true;
}
if($_GET["bgImg"]){
	$settingsStyle[1] = "\n".$_GET["bgImg"];
	$handle_bgImg = fopen("admin/settings/style.txt", "w");
	fwrite($handle_bgImg, implode('', $settingsStyle));
	$edited = true;
}


if($_GET["faviconChooser"]){
	$settingsFavicon[0] = $_GET["faviconChooser"];
	$handle_faviconChooser = fopen("admin/settings/favicon.txt", "w");
	fwrite($handle_faviconChooser, implode('', $settingsFavicon));
	$edited = true;
}

if($_GET["jQtheme"]){
	$settingsStyle[0] = $_GET["jQtheme"];
	$handle_jQtheme = fopen("admin/settings/jQueryTheme.txt", "w");
	fwrite($handle_jQtheme, implode('', $settingsStyle));
	$edited = true;
}

if($_GET["headerHeight"]){
	$settingsStyle[0] = $_GET["headerHeight"];
	$handle_headerHeight = fopen("admin/settings/header.txt", "w");
	fwrite($handle_headerHeight, implode('', $settingsStyle));
	$edited = true;
}

if($_GET["headerImgSize"]){
	$settingsStyle[1] = "\n".$_GET["headerImgSize"];
	$handle_headerImgSize = fopen("admin/settings/header.txt", "w");
	fwrite($handle_headerImgSize, implode('', $settingsStyle));
	$edited = true;
}

if($_GET["titel"]){
	//echo $_GET["p"];
	mysql_query("UPDATE `".$db_prefix."Pages` SET `Titel` = '".$_GET["titel"]."' WHERE url = '".$_GET["p"]."'", $mysql);
	mysql_query("UPDATE `".$db_prefix."Pages` SET `Datum` = '".time()."' WHERE url = '".$_GET["p"]."'", $mysql);
	$edited = true;
	$noMessage = true;
}

if($edited == true && !$noMessage){
	hinweis("Einstellungen gespeichert!");
} else if(!$noMessage){
	fehler("Einstellungen konnten nicht gespeichert werden!");
}
?>