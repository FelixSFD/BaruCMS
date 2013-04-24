<?php
/*
Name: index.php
Dateipfad: /
Version: 2.0
Erstellt: 6.6.2012
Letzte wichtige Änderung: 23.4.2013
	- Arbeit an Version 2.0
Autoren: Felix Deil
Beschreibung: index.php im Frontend
ToDo:
	- fertigstellung der Template-Integration

(c) Felix Deil 2012-2013
Diese Datei ist Teil von BaruCMS.
*/
error_reporting (E_ALL && ~E_NOTICE);
if(file_exists("setup.php")){
	header("Location: setup.php");
}
include "adminAPI.php";
include "system/classes/baruPassword.class.php";

# create content
class content
{
	private $content;
	private $pageID;
	private $pageType;
	private $module;

	public function setPageType($type, $id, $module)
	{
		if($type == "module"){
			$this->pageType = "module";
			$this->pageID = false;
			$this->module = $module;
		}
		if($type == "page"){
			$this->pageType = "page";
			$this->pageID = $id;
			$this->module = false;
		}
		if($type == "index"){
			$this->pageType = "index";
			$this->pageID = false;
			$this->module = false;
		}
	}
	public function returnPage()
	{
		include "db_config.php";
		include "system/mysqli_connect.php";
		include "system/classes/baruDate.class.php";
		
		if($this->pageType == "index"){ # Startseite
			$blogPreviewTemplate = file("templates/".getSetting("TEMPLATE")."/blogPreview.html");
			$pagesQuery = $db->query("SELECT * FROM ".$db_prefix."Pages WHERE im_Blog = '1' ORDER BY Datum DESC");
			$result = '
				<div id="welcome">'.getSetting("HELLO_TEXT").'</div>
			';
			while($pagesResult = $pagesQuery->fetch_object()){
				$date = new baruDate;
				$date->timestamp = $pagesResult->Datum;
				
				$preview = $pagesResult->Inhalt;
				$preview = strip_tags($preview, "<b><i><a><p>");
				$preview = substr($preview, 0, 400);
				
				
				$pageCategoryID = $pagesResult->Category;
				$categoryQuery = $db->query("SELECT * FROM ".$db_prefix."Categories WHERE ID = '".$pageCategoryID."'");
				$categoryResult = $categoryQuery->fetch_object();
				
				$pageCategory = $categoryResult->url;
				$pageLink = $pagesResult->url .".html";
				$pageLinkJS = "document.location.href='".$pageLink."';";
				
				$float = "left";
				
				$newElement = $blogPreviewTemplate;
				$newElement = str_replace("%baru-page-id%", $pagesResult->ID, $newElement);
				$newElement = str_replace("%baru-page-date%", $date->returnDate(), $newElement);
				$newElement = str_replace("%baru-page-link%", $pageLink, $newElement);
				$newElement = str_replace("%baru-page-link-js%", $pageLinkJS, $newElement);
				$newElement = str_replace("%baru-page-title%", $pagesResult->Titel, $newElement);
				$newElement = str_replace("%baru-page-text%", $preview, $newElement);
				$newElement = str_replace("%baru-page-float%", $float, $newElement);
				
				foreach($newElement as $blogPreview){
					$result .= $blogPreview;
				}
				
				if($float == "left"){
					$float = "right";
				} else {
					$float = "left";
				}
			}
		}
		
		if($this->pageType == "page"){ # Seite
			$showPageTemplate = file("templates/".getSetting("TEMPLATE")."/showPage.html");
			
			$pagesQuery = $db->query("SELECT * FROM ".$db_prefix."Pages WHERE url = '".$_GET["page"]."'");
			$pagesResult = $pagesQuery->fetch_object();
			
			# Datum
			$date = new baruDate;
			$date->timestamp = $pagesResult->Datum;
			
			# Text
			$content = $pagesResult->Inhalt;
			
			# Kategorie
			$categoryID = $pagesResult->Category;
			$categoryQuery = $db->query("SELECT * FROM ".$db_prefix."Categories WHERE ID = '".$categoryID."'");
			$categoryResult = $categoryQuery->fetch_object();
			$pageCategory = $categoryResult->Name;
			
			# Autor
			$authorID = $pagesResult->Autor;
			$authorQuery = $db->query("SELECT * FROM ".$db_prefix."User WHERE ID = '".$authorID."'");
			$authorResult = $authorQuery->fetch_object();
			$authorName = $authorResult->Vorname ." ".$authorResult->Nachname;
			
			# Daten einsetzen
			$showPageTemplate = str_replace("%baru-page-title%", $pagesResult->Titel, $showPageTemplate);
			$showPageTemplate = str_replace("%baru-page-content%", $content, $showPageTemplate);
			$showPageTemplate = str_replace("%baru-page-date%", $date->returnDate(), $showPageTemplate);
			$showPageTemplate = str_replace("%baru-page-author-name%", $authorName, $showPageTemplate);
			$showPageTemplate = str_replace("%baru-page-category%", $pageCategory, $showPageTemplate);
			
			# Fertige Seite ausgeben
			foreach($showPageTemplate as $showPageTemplateLine){
				$result .= $showPageTemplateLine;
			}
		}
		
		return $result;
	}
	
	public function returnPageType()
	{
		return $this->pageType;
	}
}

# Fill template
function fillTemplate($templateFile){
	include_once "adminAPI.php";
	$result = $templateFile;
	
	# head START
	$pageTitle = getSetting("PAGE_TITLE");
	$headerIncludes = '
		<script src="http://code.jquery.com/jquery-2.0.0.js"></script>
		<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	';
	# head END
	
	# search START
	$searchBox = '
		<div id="search">
			<input onkeyup="search()" type="search" id="searchField" placeholder="Suche">
		</div>
	';
	$searchList = '<div id="searchList"></div>';
	# search END
	
	if(getSetting("SEARCH_ACTIVE")){
		$headerIncludes .= '<script src="system/js/search.js"></script>';
	}
	
	# content START
	$content = new content;
	if($_GET["page"] && !$_GET["module"]){
		$pageType = "page";
	} else if($_GET["module"]){
		$pageType = "module";
	} else {
		$pageType = "index";
	}
	$content->setPageType($pageType, $_GET["page"], $_GET["module"]);
	$contentReady = $content->returnPage();
	# content END
	
	# other
	$thisTemplatePath = "templates/".getSetting("TEMPLATE");
	# other END
	
	$result = str_replace("%baru-title%", $pageTitle, $result);
	$result = str_replace("%baru-header-includes%", $headerIncludes, $result);
	$result = str_replace("%baru-this-template-path%", $thisTemplatePath, $result);
	
	$result = str_replace("%baru-search-box%", $searchBox, $result);
	$result = str_replace("%baru-search-list%", $searchList, $result);
	
	$result = str_replace("%baru-content%", $contentReady, $result);
	return $result;
}

# Load template-data
$frontendModulePath = "backend/backendModules/".$_GET["module"].".baru/frontendPage.php";
if(!$_GET["page"] && file_exists($frontendModulePath)){
	include $frontendModulePath;
} else if(!$_GET["module"]){
	$templateIndex = file("templates/".getSetting("TEMPLATE")."/index.html");
	$templateIndex = fillTemplate($templateIndex);
	
	# index.php ausgeben
	foreach($templateIndex as $templateIndexLine){
		if(strpos($templateIndexLine, "%baru-menu%")){
			$templateIndexLine = str_replace("%baru-menu%", "", $templateIndexLine);
			include "menu/menu.php";
		}
		echo $templateIndexLine;
	}
}
?>