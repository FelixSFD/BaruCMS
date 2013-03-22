<h1><? echo $lang_design; ?></h1>
<?
if($ECM["rights"]["EDIT_STYLE"]){
?>

<div id="accordion">
<!--<h2><a href="#">Allgemein</a></h2>
<div>
	<table>
		<tr>
			<td>
				<label for="pageWidth">Seitenbreite:</label>
			</td>
			<td>
				<input id="pageWidth" name="pageWidth" type="text" size="6" />
				<select	id="pxORpercent" name="pxORpercent">
					<option value="px">px</option>
					<option value="%">%</option>
				</select>
			</td>
		</tr>
	</table>
</div>-->
<h2><a href="#"><? echo $lang_mainMenu; ?></a></h2>
<div id="mainMenuStyle">
	<form>
	<table>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>
				<label for="farbschema"><b><? echo $lang_farbschema; ?>:</b></label>
			</td>
			<td>
				<select id="farbschema" name="farbschema">
					<?
					// Zeile 0: Farbschema; Zeile 1: Bezeichnung
					echo "<option value='".$setMenu[0]."'>".$setMenu[0]."</option>";
					?>
					<option value="black">schwarz</option>
					<option value="grey">grau</option>
					<option value="blue">blau</option>
					<option value="orange">orange</option>
					<option value="red">rot</option>
					<option value="green">grün</option>
					<option value="white">weiß</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="verz"><b><? echo $lang_openingSpeed; ?>:</b></label>
			</td>
			<td>
				<input type="number" id="verz" name="verz" size="2" value="<? echo $setMenu[1]; ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="kPr"><b><? echo $lang_kPr; ?>:</b></label>
			</td>
			<td>
				<input type="number" id="kPr" name="kPr" size="2" value="<? echo $setMenu[2]; ?>" />
			</td>
		</tr>
	</table>
	</form>
	<script>
	function menuStyleLoaderHide(){
		$("#menuStyleLoader").fadeOut(500);
	}
	function menuStyleLoaderShow(){
		$("#menuStyleLoader").fadeIn(500);
		setTimeout(menuStyleLoaderHide, 3000);
	}
	
	function menuStyleSave(){
		var farbschema = $("#farbschema").val();
		var verz = $("#verz").val();
		var kPr = $("#kPr").val();
		
		if(verz < 1){
			var verz = 1;
		}
		$("#menuStyleLoader").load("save.php?menuFarbschema="+farbschema+"&menuVerz="+verz+"&menuKPR="+kPr, menuStyleLoaderShow);
	}
	</script>
	<div id="menuStyleLoader" style="display: none;"></div>
	<button class="ui-state-default ui-corner-all" onclick="menuStyleSave()">Speichern</button>
</div>

<h2><a href="#"><? echo $lang_background; ?></a></h2>
<div id="bgStyle">
	<div id="uploaderDialog1" title="Uploader">
		<h3><? echo $lang_chooseFile; ?>:</h3>
		<iframe width="90%" src="upload.php?target=bg" scrolling="no" frameborder="0"><? echo fehler("Das iFrame konnte nicht geladen werden..."); ?></iframe>
	</div>
	<div id="uploaderDialog2" title="Uploader">
		<h3><? echo $lang_chooseFile; ?>:</h3>
		<iframe width="90%" src="upload.php?target=header" scrolling="no" frameborder="0"><? echo fehler("Das iFrame konnte nicht geladen werden..."); ?></iframe>
	</div>
	<table>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>
				<label for="bgColor"><b><? echo $lang_backgroundColor; ?>:</b></label>
			</td>
			<td>
				<b>#</b><input type="color" id="bgColor" name="bgColor" onkeyup="colorPreview()" value="<? echo $setStyle[0]; ?>" /><div id="colorPreview" style="border: 1px solid black; height: 40px; width: 40px;"></div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="bgImg"><b><? echo $lang_backgroundImg; ?>:</b></label>
			</td>
			<td>
				<?
				if($setStyle[1] == "1"){
					$useBgImg = "";
				} else {
					$useBgImg = "selected='selected'";
				}
				?>
				<select id="useBgImg">
					<option value="1"><? echo $lang_yes; ?></option>
					<option value="0" <? echo $useBgImg; ?>><? echo $lang_no; ?></option>
				</select>
				<b><? echo $lang_useBackgroundImg; ?></b>
				<br>
				<button class="ui-state-default ui-corner-all" onclick="newBgImg()"><? echo $lang_upload; ?></button>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</table>
	<script>
	function newBgImg(){
		$("#uploaderDialog1").dialog("open");
	}
	function newHeaderImg(){
		$("#uploaderDialog2").dialog("open");
	}
	
	function colorPreview(){
		document.getElementById("colorPreview").style.background = "#"+$("#bgColor").val();
	}
	
	function bgStyleLoaderHide(){
		$("#bgStyleLoader").fadeOut(500);
	}
	function bgStyleLoaderShow(){
		$("#bgStyleLoader").fadeIn(500);
		setTimeout(bgStyleLoaderHide, 3000);
	}
	
	function bgStyleSave(){
		var bgColor = $("#bgColor").val();
		var bgImg = $("#useBgImg").val();
		//alert(bgImg);
		$("#bgStyleLoader").load("save.php?bgColor="+bgColor+"&bgImg="+bgImg, bgStyleLoaderShow);
	}
	
	colorPreview();
	</script>
	<div id="bgStyleLoader" style="display: none;"></div>
	<button class="ui-state-default ui-corner-all" onclick="bgStyleSave()"><? echo $lang_save; ?></button>
	<br>
</div>

<h2><a href="#"><? echo $lang_header; ?></a></h2>
<div>
	<table>
		<tr>
			<td>
				<label for="headerImg"><b><? echo $lang_headerImg; ?>:</b></label>
			</td>
			<td>
				<button class="ui-state-default ui-corner-all" onclick="newHeaderImg()"><? echo $lang_upload; ?></button>
			</td>
		</tr>
		<tr>
			<td>
				<label for="headerHeight"><b><? echo $lang_headerHeight; ?>:</b></label>
			</td>
			<td>
				<input type="text" size="3" name="headerHeight" id="headerHeight" value="<? echo $setStyleHeader[0]; ?>" placeholder="<? echo $lang_headerHeight; ?>" />px
				<br>
			</td>
		</tr>
		<tr>
			<td>
				<label for="headerImgSize"><b><? echo $lang_headerBackgroundSize; ?>:</b></label>
			</td>
			<td>
				<select id="headerImgSize" name="headerImgSize">
					<option value="<? echo $setStyleHeader[1]; ?>"><? echo $setStyleHeader[1]; ?></option>
					<option value="auto">auto</option>
					<option value="cover">cover</option>
					<option value="contain">contain</option>
				</select>
			</td>
		</tr>
	</table>
	<div id="headerStyleLoader" style="display: none;"></div>
	<button class="ui-state-default ui-corner-all" onclick="headerStyleSave()"><? echo $lang_save; ?></button>
	<br>
	<script>
	function headerStyleSave(){
		var headerHeight = $("#headerHeight").val();
		var headerImgSize = $("#headerImgSize").val();
		$("#headerStyleLoader").load("save.php?headerHeight="+headerHeight+"&headerImgSize="+headerImgSize, headerStyleLoaderShow);
	}
	
	function headerStyleLoaderHide(){
		$("#headerStyleLoader").fadeOut(500);
	}
	function headerStyleLoaderShow(){
		$("#headerStyleLoader").fadeIn(500);
		setTimeout(headerStyleLoaderHide, 3000);
	}
	</script>
</div>

<h2><a href="#">Favicon</a></h2>
<div>
	<script>
	function uploadFavicon(){
		window.open("admin/uploadFavicon.php", "Favicon hochladen", "width=400,height=400,scrollbars=no,menubar=no,statusbar=no,toolbar=no");
	}
	</script>
	<button class="ui-state-default ui-corner-all" onclick="uploadFavicon()">Favicon hochladen</button>
	<br><br><br><br>
	<form method="get" action="?p=style">
		<input type="hidden" name="p" value="style">
		<?
		$verzFavicons = "img/favicons/";
		$favicons = scandir($verzFavicons);
		foreach($favicons as $f) {
		if(substr($f, -3) == "png"){
			$faviconName = substr($f, 0, -4);
			$faviconID = substr($faviconName, 8);
			?>
			<input type="radio" id="<? echo $faviconID; ?>" name="faviconChooser" value="<? echo $f; ?>"><label for="<? echo $faviconID; ?>"><img src="img/favicons/<? echo $f; ?>" width="77px" height="77px" /></label>
			<?
		}
		};
		?>
		<br>
		<button class="ui-state-default ui-corner-all"><? echo $lang_save; ?></button>
	</form>
	<?
	if($_GET["faviconChooser"]){
		include_once "save.php";
	}
	?>
</div>

<h2><a href="#">jQueryUI-Theme</a></h2>
<div id="jQdesign">
	<script>
	function jQStyleLoaderHide(){
		$("#jQStyleLoader").fadeOut(500);
	}
	function jQStyleLoaderShow(){
		$("#jQStyleLoader").fadeIn(500);
		setTimeout(jQStyleLoaderHide, 3000);
	}
	function jQStyleSave(){
		var theme = $("#jQtheme").val();
		$("#jQStyleLoader").load("save.php?jQtheme="+theme, jQStyleLoaderShow);
	}
	</script>
	<select id="jQtheme">
		<option value="<? echo $jQtheme[0]; ?>"><? echo $themeInfo[0]; ?></option>
		<?
		$verz = "system/jQuery/css/";
		$dateien = scandir($verz);
		foreach($dateien as $t) {
		if($t != "." && $t != ".." && $t != "readme.txt"){
			$info = file("system/jQuery/css/".$t."/info.txt");
			?>
			<option value="<? echo $t; ?>"><? echo $info[0]; ?></option>
			<?
		}
		};
		?>
	</select>
	<small><a href="system/jQuery/css/readme.txt" target="_blank"><? echo $lang_help; ?></a></small>
	<br>
	<div id="jQStyleLoader" style="display: none;"></div>
	<br>
	<button class="ui-state-default ui-corner-all" onclick="jQStyleSave()"><? echo $lang_save; ?></button>
</div>
<h2><a href="#"><? echo $lang_ownStyle; ?></a></h2>
<div>
<?
if($_GET["action"] == "upload-css"){
	if($_POST["useCSS"]){
		move_uploaded_file($_FILES['datei']['tmp_name'], "system/styles/userDefinied.css"); 
	} else {
		unlink("system/styles/userDefinied.css");
	}
	?>
	<script>
	function weiter(){
		document.location.href = "admin.php?p=style";
	}
	weiter();
	</script>
	<?
}
?>
<script>
function changeField() {
	if ($('#useCSS').is(':checked')) {
		$('#datei').removeAttr('disabled');
	} else {
		$('#datei').attr('disabled', true);
	}
}
</script>
<form id="fileUpload" method="post" action="?p=style&action=upload-css" enctype="multipart/form-data">
	<?
	if(file_exists("system/styles/userDefinied.css")){
		?>
		<input type="checkbox" onclick="changeField()" id="useCSS" name="useCSS" value="useCSS" checked><label for="useCSS"><? echo $lang_useOwnStyle; ?></label><br>
		<input type="file" name="datei" id="datei" required="required" /><br><br>
		<?
	} else {
		?>
		<input type="checkbox" onclick="changeField()" id="useCSS" name="useCSS" value="useCSS"><label for="useCSS"><? echo $lang_useOwnStyle; ?></label><br>
		<input type="file" name="datei" id="datei" disabled="disabled" required="required" /><br><br>
		<?
	}
	?>
	<button id="button" class="ui-state-default ui-corner-all" type="submit"><? echo $lang_save; ?></button>
</form>
</div>
</div>
<?
} else {
	fehler($lang_noPermission);
}
?>