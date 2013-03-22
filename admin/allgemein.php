<h1><? echo $lang_adminbereichAllgemein; ?></h1>
<?
if($ECM["rights"]["EDIT_GENERAL_SETTINGS"]){

if($_GET["action"] == "submit"){
	if($_POST["titel"]){
		if(setSetting("PAGE_TITLE", $_POST["titel"])){
			
		} else {
			fehler(mysql_error());
		}
	}
	if($_POST["language"]){
		if(setSetting("LANGUAGE", $_POST["language"])){
			
		} else {
			fehler(mysql_error());
		}
	}
	if($_POST["helloText"]){
		if(setSetting("HELLO_TEXT", stripslashes($_POST["helloText"]))){
			
		} else {
			fehler(mysql_error());
		}
	}
	
	if($_GET["wartungsmodus"]){
		if(setSetting("WARTUNG", $_POST["wartungsmodus"])){
			
		} else {
			fehler(mysql_error());
		}
	}
	?>
	<script>
	function weiterleitung(){
		document.location.href = "?p=allgemein";
	}
	setTimeout(weiterleitung, 2000);
	</script>
	<?
}
?>
<script> 
function postEdit() {
	document.getElementById("helloText").value = document.getElementById("inhalt").innerHTML;
	$("#richtext_formular").submit();
}
function format(command_name, command_value) {
	document.execCommand(command_name, false, command_value);
}

function html(){
	if(!editHTML){
		codeDE = document.getElementById("inhalt").innerHTML;
		$("#inhalt").hide();
		$(".html_button").hide();
		$("#textarea").show();
		document.getElementById("textarea").value = codeDE;
		$("#saveButton").hide();
		editHTML = true;
	} else {
		$("#inhalt").show();
		$("#saveButton").show();
		$(".html_button").show();
		$("#textarea").hide();
		document.getElementById("inhalt").innerHTML = document.getElementById("textarea").value;
		editHTML = false;
	}
}
editHTML = false;
</script>
<form method="post" id="richtext_formular" action="?p=allgemein&action=submit">
<table border="1">
	<tr>
		<td><? echo $lang_adminbereichAllgemeinInputLanguage; ?>:</td>
		<td>
			<select id="chooseLang" name="language">
				<?
				$verzeichnis = "languages/";
				$langs = scandir($verzeichnis);
				foreach($langs as $l) {
				if($l != "." && $l != ".." && substr($l, -4) == ".php"){
					if(getSetting("LANGUAGE") == substr($l, 0, -4)){
						?>
						<option value="<? echo substr($l, 0, -4); ?>" selected><? echo substr($l, 0, -4); ?></option>
						<?
					} else {
						?>
						<option value="<? echo substr($l, 0, -4); ?>"><? echo substr($l, 0, -4); ?></option>
						<?
					}
				}
				};
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td><? echo $lang_adminbereichAllgemeinInputTitle; ?>:</td>
		<td><input type="text" name="titel" size="70" value="<? echo getSetting("PAGE_TITLE"); ?>" placeholder="<? echo $lang_adminbereichAllgemeinInputTitle; ?>"></td>
	</tr>
	<tr>
		<td><? echo $lang_adminbereichAllgemeinInputHello; ?>:</td>
		<td>
			<!--<input type="hidden" name="helloText" id="helloText" value=""> 
			<button type="button" onclick="format('insertparagraph','<p>');" title="Textabsatz">¶</button>
			<button type="button" onclick="format('formatblock','<h1>');" title="Überschrift 1. Ordnung">H1</button>
			<button type="button" onclick="format('formatblock','<h2>');" title="Überschrift 2. Ordnung">H2</button>
			<button type="button" onclick="format('formatblock','<h3>');" title="Überschrift 3. Ordnung">H3</button>
			<button type="button" onclick="format('formatblock','<h4>');" title="Überschrift 4. Ordnung">H4</button>
			<button type="button" onclick="format('insertunorderedlist','');" title="Unsortierte Liste">?</button>
			<button type="button" onclick="format('insertorderedlist','');" title="Unsortierte Liste">1.</button>
			&nbsp;
			<button type="button" onclick="format('inserthorizontalrule','');"  title="Trennlinie">&mdash;</button>
			<button type="button" onclick="format('bold','');"><b>B</b></button>
			<button type="button" onclick="format('italic','');"><i>I</i></button>
			<button type="button" onclick="format('subscript','');"><span style="font-size: 65%;"><sub>X</sub></span></button>
			<button type="button" onclick="format('superscript','');"><span style="font-size: 65%;"><sup>X</sup></span></button>
			<button type="button" onclick="document.execCommand('createlink');"><span style="text-decoration: underline;">link</span></button>
			&nbsp;
			<button type="button" onclick="format('justifyleft','');">|= </button>
			<button type="button" onclick="format('justifyright','');"> =|</button>
			<button type="button" onclick="format('justifycenter','');">)=(</button>
			<button type="button" onclick="format('justifyfull','');">|=|</button>
			&nbsp;
			<button type="button" onclick="html();">HTML</button>
			<textarea id="textarea" style="display: none;" rows="20" cols="90"></textarea>
			<div contenteditable="true" id="inhalt" style="border: solid 1px #D0D0D0; padding: 5px; height: 350px; width: 90%; overflow: scroll;">
				<? echo getSetting("HELLO_TEXT"); ?>
			</div>-->
			<textarea name="helloText" class="advancedEditor" rows="20" cols="90"><? echo getSetting("HELLO_TEXT"); ?></textarea>			
		</td>
	</tr>
	<tr>
		<td></td>
		<td><button onclick="postEdit()" class="ui-state-default ui-corner-all"><? echo $lang_save; ?></button></td>
	</tr>
</table>
</form>
<hr>
<h1><? echo $lang_wartungsmodus; ?></h1>
<form method="post" action="?p=allgemein&action=submit&wartungsmodus=change">
<table>
	<tr>
		<td><? echo $lang_adminbereichAllgemeinWartung; ?>:</td>
		<td>
			<?
			if(getSetting("WARTUNG") == "1"){
				?>
				<input type="checkbox" name="wartungsmodus" id="wartungsmodus" value="1" checked />
				<?
			} else {
				?>
				<input type="checkbox" name="wartungsmodus" id="wartungsmodus" value="1" />
				<?
			}
			?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" class="ui-state-default ui-corner-all" value="<? echo $lang_save; ?>"></td>
	</tr>
</table>
</form>
<hr>
<h1><? echo $lang_license; ?></h1>
<?
$activation = file_get_contents($activationURL.'check.php?host='.urlencode($_SERVER["SERVER_NAME"])."&code=".$licenseCode[0]);
if($activation == "valid"){
	hinweis($lang_licenseValid);
	echo "<h2>".$lang_moreInfo.":</h2>";
	$activationInfo = file_get_contents($activationURL.'licenseInfo.php?host='.urlencode($_SERVER["SERVER_NAME"])."&code=".$licenseCode[0]);
	echo $activationInfo;
} else if($activation){
	fehler($lang_licenseUnknownError);

} else {
	fehler($lang_license404);
}

//permission-check END
} else {
	fehler($lang_noPermission);
}
?>