<?php
class Controller
{
	private $request;
	private $template;
	private $pageType = "default";
	private $settings = array();
	private $headerIncludes;
	private $mainMenu;
	private $blogEntries = array();
	private $currentPageData = array();
	private $currentPageDataAuthor = array();
	
	public function __construct($request)
	{
		$this->request = $request;
		$model = new Model;
		$this->template = $model->template;
		$this->settings = $model->loadSettings();
		$this->headerIncludes = $model->getHeaderIncludes();
		$this->mainMenu = $model->getMenu();
		$this->blogEntries = $model->getBlogEntries();
		
		# pageType ermitteln
		if($request["pageID"] && $request["view"] == "page"){
			$this->pageType = "page";
			$loadPage = true;
		} else if($request["pageID"] && ($request["view"] == "entry" or !$request["view"])){
			$this->pageType = "entry";
			$loadPage = true;
		}
		
		if($loadPage){
			$this->currentPageData = $model->getPage($request["pageID"]);
			$this->currentPageData["AuthorInfo"] = $model->getUser($this->currentPageData["Autor"]);
			$this->currentPageData["Category"] = $model->getCategory($this->currentPageData["Category"]);
			include_once "system/classes/baruDate.class.php";
			$date = new baruDate($this->currentPageData["Datum"]);
			$this->currentPageData["Datum"] = $date->returnDate();
		}
	}
	
	public function display()
	{
		$view = new View($this->template, $this->pageType);
		
		# Variablen zuweisen
		$view->assign("headerIncludes", $this->headerIncludes);
		$view->assign("title", $this->settings["PAGE_TITLE"]);
		$view->assign("welcome", $this->settings["HELLO_TEXT"]);
		$view->assign("mainMenu", $this->mainMenu);
		$view->assign("blogEntries", $this->blogEntries);
		$view->assign("pageType", $this->pageType);
		$view->assign("pageData", $this->currentPageData);
		
		if($this->settings["SEARCH_ACTIVE"]){
			$view->assign("searchResultDiv", '<div id="searchList"></div>');
			$view->assign("searchBox", '
				<div id="search">
					<input onkeyup="search()" type="search" id="searchField" placeholder="Suche">
				</div>
			');
		}
		
		# Template füllen und anzeigen
		$filledTemplate = $view->fillTemplate();
		return $filledTemplate;
	}
}
?>