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
		$pagesInCategory = array();
		$pages = new baruSQL("SELECT * FROM ".$db_prefix."Pages WHERE `im_Blog` = '1'");
		foreach($pages->returnData("object") as $pagesResult){
			$entry[$pagesResult->ID]["Titel"] = $pagesResult->Titel;
			$entry[$pagesResult->ID]["Autor"] = $pagesResult->Autor;
			$entry[$pagesResult->ID]["Inhalt"] = $pagesResult->Inhalt;
			$entry[$pagesResult->ID]["ID"] = $pagesResult->ID;
			$entry[$pagesResult->ID]["Category"] = $pagesResult->Category;
			
			$pagesInCategory[$pagesResult->Category]++;
			
			include_once "system/classes/baruDate.class.php";
			$date = new baruDate($pagesResult->Datum);
			$entry[$pagesResult->ID]["Datum"] = $date->returnDate();
		}
		$entry["pagesInCategory"] = $pagesInCategory;
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
		$catResult = $category->returnData("array");
		return $catResult[0];
	}
	
	public function userCanView($type, $id){
		require "adminAPI.php";

		switch($type){
			case "category": //CATEGORY
				$category = $this->getCategory($id);

				if($baru["login_ok"] || $category["visibility"] == "public" || $category["visibility"] == "hidden"){
					$canViewResult = true;
				} else if($category["visibility"] == "private"){
					if($baru["login_ok"]){
						$canViewResult = true;
					} else {
						$canViewResult = false;
						return false;
					}
				} else {
					$canViewResult = false;
				}
				break;
			case "entry": //ENTRY
				$page = $this->getPage($id);

				if($baru["login_ok"] || $page["im_Blog"] == "1"){
					$canViewResult = true;
				} else if($page["im_Blog"] == "0"){
					if($baru["login_ok"]){
						$canViewResult = true;
					} else {
						$canViewResult = false;
					}
				} else {
					$canViewResult = false;
				}
				break;
			case "page": //PAGE
				$page = $this->getPage($id);

				if($baru["login_ok"] || $page["im_Blog"] == "1"){
					$canViewResult = true;
				} else if($page["im_Blog"] == "0"){
					if($baru["login_ok"]){
						$canViewResult = true;
					} else {
						$canViewResult = false;
					}
				} else {
					$canViewResult = false;
				}
				break;
			case "default":
				$canViewResult = true;
				break;
		}
		return $canViewResult;
	}
}
?>