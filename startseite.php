<div id="welcome">
	<?php
	echo nl2br(getSetting("HELLO_TEXT"));
	?>
</div>
<br><br>
<div id="pagePreview">
	<?php
	$pages = mysql_query("SELECT * FROM ".$db_prefix."Pages WHERE im_Blog = 1 AND Datum < ".time()." ORDER BY Datum DESC", $mysql);
	if(mysql_error()){
		fehler(mysql_error());
	}

	$ausrichtung = "left";
	
	while ($p = mysql_fetch_array($pages)){
		?>
		<div id="p_<?php echo $p["ID"]; ?>" class="vorschau <?php echo $ausrichtung; ?>">
			<small class="date"><? echo date("H:i - d.m.Y", $p["Datum"]); ?></small>
			<h3 class="pointer" onclick="link('<?php echo $p["url"]; ?>.html')"><?php echo $p["Titel"]; ?></h3>
			<?php echo substr(strip_tags($p["Inhalt"], "<b><i><a><p>"), 0, 400); ?>
			<br>
			<a href="<?php echo $p["url"]; ?>.html" class="readmoreLink"><?php echo $lang_weiterlesen; ?></a>
		</div>
		<?
		if($ausrichtung == "left"){
			$ausrichtung = "right";
		} else {
			$ausrichtung = "left";
		}
	}
	?>
</div>