<?php
class Model
{
	public $template;
	private $pageType;
	private $contentData = array();
	private $setting = array();
	private $pagesResult = array();
	
	public function __construct()
	{
		$this->setTemplate();
		$this->loadSettings();
	}
	
	private function setTemplate()
	{
		include "db_config.php";
		include "system/mysqli_connect.php";
		$templateQuery = $db->query("SELECT * FROM ".$db_prefix."Settings WHERE Name = 'TEMPLATE'");
		$templateResult = $templateQuery->fetch_object();
		$this->template = $templateResult->Value;
	}
	
	public function loadSettings()
	{
		include "db_config.php";
		include "system/mysqli_connect.php";
		$settingsQuery = $db->query("SELECT * FROM ".$db_prefix."Settings");
		while($settingsResult = $settingsQuery->fetch_object()){
			$setting[$settingsResult->Name] = $settingsResult->Value;
		}
		$this->settings = $setting;
		return $setting;
	}
	
	public function getHeaderIncludes()
	{
		ob_start();
		include "system/headerIncludes.php";
		$headerIncludes = ob_get_contents();
		ob_end_clean();
		return $headerIncludes;
	}
	
	public function getMenu()
	{
		ob_start();
		include "menu/menu.php";
		$mainMenu = ob_get_contents();
		ob_end_clean();
		return $mainMenu;
	}
	
	public function getBlogEntries()
	{
		include "db_config.php";
		include "system/mysqli_connect.php";
		$pagesQuery = $db->query("SELECT * FROM ".$db_prefix."Pages WHERE `im_Blog` = '1'");
		while($pagesResult = $pagesQuery->fetch_object()){
			$entry[$pagesResult->ID]["Titel"] = $pagesResult->Titel;
			$entry[$pagesResult->ID]["Autor"] = $pagesResult->Autor;
			$entry[$pagesResult->ID]["Inhalt"] = $pagesResult->Inhalt;
			$entry[$pagesResult->ID]["ID"] = $pagesResult->ID;
			
			include_once "system/classes/baruDate.class.php";
			$date = new baruDate($pagesResult->Datum);
			$entry[$pagesResult->ID]["Datum"] = $date->returnDate();
		}
		return $entry;
	}
	
	public function getPage($id)
	{
		include "db_config.php";
		include "system/mysqli_connect.php";
		$pagesQuery = $db->query("SELECT * FROM ".$db_prefix."Pages WHERE ID = '".$id."'");
		$pagesResult = $pagesQuery->fetch_array();
		return $pagesResult;
	}
	
	public function getUser($id)
	{
		include "db_config.php";
		include "system/mysqli_connect.php";
		$userQuery = $db->query("SELECT * FROM ".$db_prefix."User WHERE ID = '".$id."'");
		$userResult = $userQuery->fetch_array();
		return $userResult;
	}
	
	public function getCategory($id)
	{
		include "db_config.php";
		include "system/mysqli_connect.php";
		$catQuery = $db->query("SELECT * FROM ".$db_prefix."Categories WHERE ID = '".$id."'");
		$catResult = $catQuery->fetch_array();
		return $catResult;
	}
}
?>