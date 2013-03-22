<?php include "system/config.php"; ?>
<?php
function datum($timestamp){
	
	$monat[1] = $lang_month_jan; 
	$monat[2] = $lang_month_feb; 
	$monat[3] = $lang_month_mar; 
	$monat[4] = $lang_month_apr; 
	$monat[5] = $lang_month_may; 
	$monat[6] = $lang_month_jun; 
	$monat[7] = $lang_month_jul; 
	$monat[8] = $lang_month_aug; 
	$monat[9] = $lang_month_sep; 
	$monat[10] = $lang_month_oct; 
	$monat[11] = $lang_month_nov; 
	$monat[12] = $lang_month_dec; 
	
	$tag[1] = $lang_day_mon; 
	$tag[2] = $lang_day_tue; 
	$tag[3] = $lang_day_wed; 
	$tag[4] = $lang_day_thu; 
	$tag[5] = $lang_day_fri; 
	$tag[6] = $lang_day_sat; 
	$tag[7] = $lang_day_sun; 
	
	$uhrzeit = date("H:i", $timestamp);
	$monatZahl = date("n", $timestamp);
	$jahr = date("Y", $timestamp);
	$tagZahl1 = date("j", $timestamp);
	$tagZahl2 = date("w", $timestamp);
	
	$datumFull = $tag[$tagZahl2].", ".$tagZahl1.". ".$monat[$monatZahl]." ".$jahr." - ".$uhrzeit;
	
	echo "<span class='datum'>".$datumFull."</span>";
}
?>
<html>
<head>
	<title><?php echo getSetting("PAGE_TITLE"); ?></title>
	<script type="text/javascript" src="/cms/languages/loader.js"></script>
	<link rel="icon" href="img/favicons/<?php echo $favicon[0]; ?>"/>
	<link rel="apple-touch-icon" href="img/favicons/favicon_green.png"/>
	<style>
	#header{
		height: <?php echo $setStyleHeader[0]; ?>;
		background: url('img/header.png');
		background-size: <?php echo $setStyleHeader[1]; ?>;
		background-position: center;
		background-repeat: no-repeat;
	}
	
	#wartungInfo{
		position: fixed;
		right: 10px;
		bottom: 10px;
		background-color: red;
		height: 40px;
		box-shadow: 0px 0px 20px yellow;
		border-radius: 10px;
	}
	#wartungInfo b{
		position: relative;
		text-decoration: blink;
		top: 10px;
	}
	
	#slowInfo{
		position: fixed;
		left: 10px;
		bottom: 10px;
		background-color: red;
		height: 40px;
		box-shadow: 0px 0px 20px yellow;
		border-radius: 10px;
	}
	#slowInfo b{
		position: relative;
		text-decoration: blink;
		/*top: 10px;*/
	}
	
	#userList tr td:hover{
		background: grey;
	}
	
	/*
	.left{
		float: left;
	}
	.right{
		float: right;
	}
	*/
	.clear{
		clear:left;
		clear:right;
	}
	
	.closeX{
		position: relative;
		top: 3px;
		left: 3px;
	}
	
	.editLink{
		font-weight: normal;
		font-size: 9pt;
	}
	
	#banner{
		position: absolute;
		color: black;
		top: 20px;
		left: -40px;
		height: 25px;
		width: 150px;
		background: orange;
		transform: rotate(-45deg);
		-moz-transform: rotate(-45deg);
		-webkit-transform: rotate(-45deg);
		box-shadow: 2px 2px 5px #000;
	}
	
	.pointer{
		cursor: pointer;
	}
	
	/* Dynamisch */
	html{
		<?php
		if($setStyle[1] == "1"){
			echo "background: url('img/bg.png')";
		} else {
			echo "background: #".$setStyle[0];
		}
		?>
	}
	</style>
</head>
<body>
<?php
if(substr($_SERVER["SCRIPT_FILENAME"], -9) == "index.php"){
	$verz = "templates/";
	$dateien = scandir($verz);
	foreach($dateien as $t) {
		if($t == getSetting("TEMPLATE")){
			$templatePath = "templates/".$t."/init.php";
			if(file_exists($templatePath)){
				include $templatePath;
			}
		}
	}
}

/*if(!$html5){
	?>
	<div id="oldBrowser" title="Browser veraltet">
		<p><? echo $lang_oldBrowser1; ?> <a href="http://www.mozilla.org/">Mozilla Firefox</a> <? echo $lang_oldBrowser2; ?></p>
	</div>
	<?
}*/

if($wartung2){
	?>
	<div id="wartungInfo">
		<b>&nbsp;&nbsp;&nbsp;<?php echo $lang_wartungsmodusAktiv2; ?>&nbsp;&nbsp;&nbsp;</b>
	</div>
	<?php
}
?>
	<div id="main">
		<div id="header">
			<?php
			if(getSetting("SEARCH_ACTIVE")){
				?>
				<script>
				function search(){
					var string = $("#searchField").val();
					if(string.length >= <?php echo getSetting("SEARCH_MIN_LENGTH"); ?>){
						jQuery.ajax({
							type: "GET",
							url: "search.php?q="+string,
							success: function(response)
							{
								if(response){
									//alert(response);
									$("#searchList").html(response);
									$("#content").hide();
									$("#searchList").show();
								} else {
									alert("Fehler beim Ausf&uuml;hren der AJAX-Anfrage!");
									$("#content").show();
									$("#searchList").hide();
								}
							}
						});
					} else {
						$("#content").show();
						$("#searchList").hide();
					}
				}
				</script>
				<div id="search">
					<input onkeyup="search()" type="search" id="searchField" placeholder="<?php echo $lang_search; ?>">
				</div>
				<?php
			}
			?>
		</div>
		<div id="banner">
			<center><b>BETA</b></center>
		</div>
		<div id="menu" class="<?php echo $setMenu[0]; ?>">
			<?php include "menu/menu.php"; ?>
		</div>
		<br><br><br>
		<div id="searchList">
		
		</div>
		<div id="content">
			<?php
			if(!$_GET["p"] or $_GET["p"] == "index"){
				include "startseite.php";
			} else if($_GET["p"] == "not-ready"){
				fehler("Diese Seite wurde nicht vollständig verarbeitet!");
			} else {
				$pages = mysql_query("SELECT * FROM ".$db_prefix."Pages WHERE url = '".$_GET["p"]."'", $mysql);
				if(mysql_error()){
					$error404 = true;
				}
				$p = mysql_fetch_array($pages);
				if(!$p["ID"]){
					$error404 = true;
				}
				if($p["im_Blog"] == "1"){
					echo "<small><a href='index.html'>".$lang_back."</a><br>".date("H:i - d.m.Y", $p["Datum"])."</small>";
				}
				
				if($ECM["rights"]["EDIT_PAGE"]){
					?>
					<script>
					function editPageTitle(){
						$("#editPageTitleDiv").fadeIn("fast");
						$("#pageTitleH1").fadeOut("fast");
						document.getElementById("titel").focus();
						return false;
					}
					
					function savePageTitle(){
						$("#editPageTitleDiv").fadeOut("fast");
						$("#pageTitleH1").fadeIn("fast");
						var titelNeu = $("#titel").val();
						$("#titleLoader").load("save.php?p=<?php echo $_GET["p"]; ?>&titel="+encodeURI(titelNeu));
						$("#pageTitle").html(titelNeu);
						return false;
					}
					</script>
					<div id="editPageTitleDiv" style="display: none;">
						<form onsubmit="return savePageTitle();">
							<b><?php echo $lang_adminbereichPagesListTitle; ?>:</b><input type="text" id="titel" size="59" value="<?php echo $p["Titel"]; ?>">
						</form>
						<span id="titleLoader"></span>
					</div>
					<h1 id="pageTitleH1"><span id="pageTitle"><?php echo $p["Titel"]; ?></span> <sup class="editLink"><a href="" onclick="return editPageTitle();">[<?php echo $lang_edit; ?>]</a></sup></h1>
					<?php
				} else {
					?>
					<h1><?php echo $p["Titel"]; ?></h1>
					<?php
				}
				//Text bearbeiten
				$textFertig = $p["Inhalt"];
				$textFertig = autolink($textFertig, array("target"=>"_blank"));
				$textFertig = str_replace("http:/<a ", "<a ", $textFertig);
				$textFertig = bbCodeIMG($textFertig);
				$textFertig = bbCodeYT($textFertig);
				echo $textFertig;
				if($p["im_Blog"] == "1"){
					echo "<hr>";
					
					$autor = mysql_query("SELECT * FROM ".$db_prefix."User WHERE ID = ".$p["Autor"], $mysql);
					if(mysql_error()){
						$autor = $lang_unbekannt; 
					}
					$a = mysql_fetch_array($autor);
					$autor = $a["Vorname"]." ".$a["Nachname"]; 
					echo "<small>".$lang_author.": ".$autor."</small>";
				}
				
				if($error404 == true){
					fehler($lang_error404);
				} else {
					?>
					<div id="socialshareprivacy"></div>
					<?php
				}
			}
			?>
		</div>
		<?php include "footer.php"; ?>
	</div>
</body>
</html>