<?php
foreach($this->_["blogEntries"] as $entry){
	if($entry["Category"] == $_GET["category"]){
	$link = "?category=".$entry["Category"]."&pageID=".$entry["ID"];
		?>
		<div class="vorschau">
			<small class="date"><?php echo $entry["Datum"]; ?></small>
			<h3 class="pointer" onclick="document.location.href='?pageID=<?php echo $link; ?>'"><?php echo $entry["Titel"]; ?></h3>
			<p><?php echo substr(strip_tags($entry["Inhalt"], "<p><b><i><small><br></br>"), 0, 400); ?></p>
			<a href="<?php echo $link; ?>" class="readmoreLink">weiterlesen...</a>
		</div>
		<?php
	}
}
?>