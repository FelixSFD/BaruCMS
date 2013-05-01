<?php
include "db_config.php";
include "system/mysqli_connect.php";
class menuCategory
{
	public $name;
	public $links;
	public function addLink($id, $type, $title)
	{
		$this->links .= '<li><a href="?pageID='.$id.'">'.$title.'</a></li>';
	}
}

$menuReady = '<ul id="main-menu">';
$menuReady .= '<li><a href="index.php">Home</a></li>';
$categoriesQuery = $db->query("SELECT * FROM ".$db_prefix."Categories ORDER BY Name");
while($categoriesResult = $categoriesQuery->fetch_object()){
	if($categoriesResult->visibility == "public" or ($categoriesResult->visibility == "private" && $baru["login_ok"])){
		$cat = new menuCategory;
		$cat->name = $categoriesResult->Name;
		$menuReady .= '<li data-status="closed" data-id="'.$categoriesResult->ID .'" class="layer1 closed">';
		$menuReady .= '<a href="javascript:void(0);">'.$categoriesResult->Name .'</a>';
		$menuReady .= '<ul class="layer2">';
		$pagesQuery = $db->query("SELECT * FROM ".$db_prefix."Pages WHERE Category = '".$categoriesResult->ID."'");
		while($pagesResult = $pagesQuery->fetch_object()){
			$cat->addLink($pagesResult->ID, $pagesResult->im_Blog, $pagesResult->Titel);
		}
		$menuReady .= $cat->links;
		$menuReady .= '</ul>';
		$menuReady .= '</li>';
	}
	
}
$menuReady .= "</ul>";

echo $menuReady;
?>