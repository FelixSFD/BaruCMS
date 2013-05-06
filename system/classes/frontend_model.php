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
		include "adminAPI.php";
		$template = new baruSQL("SELECT * FROM ".$db_prefix."Settings WHERE Name = 'TEMPLATE'");
		$templateArray = $template->returnData("array");
		$this->template = $templateArray[0]["Value"];
	}
	
	public function loadSettings()
	{
		include "adminAPI.php";
		$settings = new baruSQL("SELECT * FROM ".$db_prefix."Settings");
		foreach($settings->returnData("array") as $setting){
			$settingArray[$setting["Name"]] = $setting["Value"];
		}
		$this->settings = $settingArray;
		return $this->settings;
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
		include "adminAPI.php";
		$pages = new baruSQL("SELECT * FROM ".$db_prefix."Pages WHERE `im_Blog` = '1'");
		foreach($pages->returnData("object") as $pagesResult){
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
		include "adminAPI.php";
		$page = new baruSQL("SELECT * FROM ".$db_prefix."Pages WHERE ID = '".$id."'");
		$pagesResult = $page->returnData("array");
		return $pagesResult[0];
	}
	
	public function getUser($id)
	{
		include "adminAPI.php";
		$user = new baruSQL("SELECT * FROM ".$db_prefix."User WHERE ID = '".$id."'");
		$userResult = $user->returnData("array");
		return $userResult[0];
	}
	
	public function getCategory($id)
	{
		include "adminAPI.php";
		$category = new baruSQL("SELECT * FROM ".$db_prefix."Categories WHERE ID = '".$id."'");
		$carResult = $category->returnData("array");
		return $catResult[0];
	}
}
?>