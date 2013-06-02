<?php
include "db_config.php";
class menuCategory
{
	public $name;
	public $links;
	public function addLink($id, $category, $type, $title)
	{
		$this->links .= '<li><a href="?category='.$category.'&pageID='.$id.'">'.$title.'</a></li>';
	}
}

$menuReady = '<ul id="main-menu">';
$menuReady .= '<li><a href="index.php">Home</a></li>';
$categories = new baruSQL("SELECT * FROM ".$db_prefix."Categories ORDER BY Name");
foreach($categories->returnData("array") as $categoriesResult){
	if($categoriesResult["visibility"] == "public" or ($categoriesResult["visibility"] == "private" && $baru["login_ok"])){
		$cat = new menuCategory;
		$cat->name = $categoriesResult["Name"];
		$menuReady .= '<li data-status="closed" data-id="'.$categoriesResult["ID"].'" class="layer1 closed">';
		$menuReady .= '<a href="?category='.$categoriesResult["ID"].'">'.$categoriesResult["Name"].'</a>';
		$menuReady .= '<ul class="layer2">';
		$pagesM = new baruSQL("SELECT * FROM ".$db_prefix."Pages WHERE Category = '".$categoriesResult["ID"]."'");
		foreach($pagesM->returnData("array") as $pagesMresult){
			$cat->addLink($pagesMresult["ID"], $pagesMresult["Category"], $pagesMresult["im_Blog"], $pagesMresult["Titel"]);
		}
		$menuReady .= $cat->links;
		$menuReady .= '</ul>';
		$menuReady .= '</li>';
	}
}
$menuReady .= "</ul>";

echo $menuReady;
?>