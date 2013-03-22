<h1><? echo $lang_adminMenueElementPages; ?></h1>
<?
if(!$_GET["page"] && !$_GET["new"] && !$_GET["action"]){
	if($_GET["delete"] == true){
		mysql_query("DELETE FROM `".$db_prefix."Pages` WHERE ID = ".$_GET["pID"], $mysql);
		hinweis($lang_pageDeleted);
		?>
		<script>
		function weiterleitung(){
			document.location.href = "?p=pages";
		}
		//setTimeout(weiterleitung, 2200);
		</script>
		<?
	}
	?>
	<script>
	function delPage(pID, pName){
		$("#deleteDialog").dialog("open");
		$("#pageName").html(pName);
		
		var buttons = $("#deleteDialog").dialog("option", "buttons");
		$("#deleteDialog").dialog("option", "buttons", [
			{
				text: "<? echo $lang_deletePage; ?>",
				click: function() {
					$(this).dialog("close");
					document.location.href = "admin.php?p=pages&delete=true&pID="+pID;
				}
			}
		] );
	}
	
	function newPage(){
		document.location.href = "?p=pages&new=true";
	}
	function editPage(pID){
		document.location.href = "?p=pages&page="+pID;
	}
	</script>
	<div id="deleteDialog" title="<? echo $lang_confirmDelete; ?>">
		<h3><? echo $lang_confirmDeletePage1; ?> "<span id="pageName" style="font-style: italic;"></span>" <? echo $lang_confirmDeletePage2; ?></h3>
	</div>
	<div id="delLoader">
	</div>
	<h2><? echo $lang_adminbereichPagesList; ?></h2>
	<?
	if($ECM["rights"]["ADD_PAGE"]){
		?>
		<div id="userNewLink" class="right">
			<button onclick="newPage()" class="ui-state-default ui-corner-all right"><? echo $lang_adminbereichNewPage; ?></button>
		</div>
		<div class="clear"></div>
		<br>
		<?
	}
	?>
	<table id="pagesList">
	<thead>
		<td>ID</td>
    	<td><? echo $lang_adminbereichPagesListTitle; ?></td>
        <td><? echo $lang_adminbereichPagesListAuthor; ?></td>
		<td><? echo $lang_adminbereichPagesListDate; ?></td>
		<td><? echo $lang_actions; ?></td>
    </thead>
    <?
	$pages = mysql_query("SELECT * FROM ".$db_prefix."Pages", $mysql);
	if(mysql_error()){
		fehler(mysql_error());
	}
	while ($p = mysql_fetch_array($pages)) {
		?>
        <tr>
        	<td><? echo $p["ID"]; ?></td>
			<td><? echo $p["Titel"]; ?></td>
        	<td>
			<?
			$autor = mysql_query("SELECT * FROM ".$db_prefix."User WHERE ID = ".$p["Autor"], $mysql);
			if(mysql_error()){
				$autor = $lang_unbekannt; 
			}
			$a = mysql_fetch_array($autor);
			$autor = $a["Vorname"]." ".$a["Nachname"]; 
			echo $autor;
			?>
			</td>
			<td><? echo date("d.m.y - H:i", $p["Datum"]); ?></td>
			<td>
			<?
			if($ECM["rights"]["DELETE_PAGE"]){
				?>
				<button class="ui-state-default ui-corner-all right" onclick="delPage('<? echo $p["ID"]; ?>', '<? echo $p["Titel"]; ?>')"><? echo $lang_delete; ?></button>
				<?
			}
			if($ECM["rights"]["EDIT_PAGE"]){
				?>
				<button class="ui-state-default ui-corner-all right" onclick="editPage('<? echo $p["ID"]; ?>')"><? echo $lang_edit; ?></button></td>
				<?
			}
			?>
        </tr>
        <?
	}
	?>
</table>
	<?
} else if(!$_GET["page"] && $_GET["new"] && $ECM["rights"]["ADD_PAGE"]){
	?>
	<h2><? echo $lang_newPageTitle; ?></h2>
	<div id="newPageForm">
	<script>
	createLinkBack("?p=pages");
	
	function postEdit() {
		document.getElementById("text").value = document.getElementById("inhalt").innerHTML;
		$("#richtext_formular").submit();
	}
	function format(command_name, command_value) {
		document.execCommand(command_name, false, command_value);
	}
	</script> 
	<style>
	button { margin-right: 0; margin-left: -3px; }
	</style>
	<form method="post" id="richtext_formular" action="?p=pages&action=new">
		<input type="checkbox" value="1" name="blog"><label for="blog"><b><? echo $lang_editPageShowInBlog; ?></b><small>(<? echo $lang_confirmEveryTime; ?>)</small></label>
		<br>
		<label for="title"><b><? echo $lang_adminbereichPagesListTitle; ?>: </b></label><input type="text" id="title" name="titel" placeholder="<? echo $lang_adminbereichPagesListTitle; ?>" size="59"><br>
		<!--<input type="hidden" name="text" id="text" value=""> 
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
		<div contenteditable="true" id="inhalt" style="border: solid 1px #D0D0D0; padding: 5px; height: 350px; width: 90%; overflow: scroll;">
		</div>
		<button onclick="postEdit()"><? echo $lang_save; ?></button>-->
		<textarea name="text" class="advancedEditor" rows="20" cols="90"></textarea><br>
		<button onclick="postEdit()"><? echo $lang_save; ?></button>
	</form>
	</div>
	<?
} else if(!$_GET["page"] && $_GET["new"] && !$ECM["rights"]["ADD_PAGE"]){
	fehler($lang_noPermission);
} else if($_GET["action"] == "new"){
	//echo $_POST["datum"]."<br>";
	$monat = substr($_POST["datum"],-16,2);
	$tag = substr($_POST["datum"],-13,2);
	$jahr = substr($_POST["datum"],-10,4);
	$stunden = substr($_POST["datum"],-5,2);
	$minuten = substr($_POST["datum"],-2,2);
	/*echo substr($_POST["datum"],-16,2)."<br>";
	echo substr($_POST["datum"],-13,2)."<br>";
	echo substr($_POST["datum"],-10,4)."<br>";
	echo substr($_POST["datum"],-5,2)."<br>";
	echo substr($_POST["datum"],-2,2)."<br>";*/
	$newTimestamp = mktime($stunden,$minuten,0,$monat,$tag,$jahr);
	$newTimestamp = time();
	$pageURL = strtoURL($_POST["titel"]);
	if(!$pageURL){
		$pageURL = "not-ready";
	}
	
	mysql_query("INSERT INTO `".$db_prefix."Pages` VALUES ('', '".$_POST["titel"]."', '".$_POST["text"]."', '".$ECM["userID"]."', '".$pageURL."', '".$_POST["blog"]."', '".$newTimestamp."')", $mysql);
	?>
	<script>
	function weiterleitung(){
		document.location.href = "?p=pages";
	}
	setTimeout(weiterleitung, 2500);
	</script>
	<?
	if(mysql_error()){
		fehler(mysql_error());
	} else {
		hinweis($lang_newPageSaved);
	}
} else if($_GET["page"] > 0){
	?>
	<h2><? echo $lang_editPageTitle; ?></h2>
	<?
	if($_GET["action"] == "save"){
		mysql_query("UPDATE `".$db_prefix."Pages` SET `Titel` = '".$_POST["titel"]."' WHERE ID = ".$_GET["page"], $mysql);
		mysql_query("UPDATE `".$db_prefix."Pages` SET `Inhalt` = '".$_POST["text"]."' WHERE ID = ".$_GET["page"], $mysql);
		mysql_query("UPDATE `".$db_prefix."Pages` SET `im_Blog` = '".$_POST["blog"]."' WHERE ID = ".$_GET["page"], $mysql);
		mysql_query("UPDATE `".$db_prefix."Pages` SET `Datum` = '".time()."' WHERE ID = ".$_GET["page"], $mysql);
		hinweis($lang_newPageSaved);
		?>
		<script>
		function weiterleitung(){
			document.location.href = "?p=pages";
		}
		setTimeout(weiterleitung, 2500);
		</script>
		<?
	}
	
	$pages = mysql_query("SELECT * FROM ".$db_prefix."Pages WHERE ID = ".$_GET["page"], $mysql);
	if(mysql_error()){
		fehler(mysql_error());
	}
	$p = mysql_fetch_array($pages);
	?>
	<script>
	createLinkBack("?p=pages");
	
	function postEdit() {
		document.getElementById("text").value = document.getElementById("inhalt").innerHTML;
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
	<style>
	button { margin-right: 0; margin-left: -3px; }
	</style>
	<form method="post" id="richtext_formular" action="?p=pages&page=<? echo $_GET["page"]; ?>&action=save">
		<input type="checkbox" value="1" name="blog"><label for="blog"><b><? echo $lang_editPageShowInBlog; ?></b><small>(<? echo $lang_confirmEveryTime; ?>)</small></label>
		<br>
		<label for="title"><b><? echo $lang_adminbereichPagesListTitle; ?>: </b></label><input type="text" id="title" name="titel" placeholder="<? echo $lang_adminbereichPagesListTitle; ?>" size="59" value="<? echo $p["Titel"]; ?>"><br>
		<!--<input type="hidden" name="text" id="text" value=""> 
		<button type="button" class="html_button" onclick="format('insertparagraph','<p>');" title="Textabsatz">¶</button>
		<button type="button" class="html_button" onclick="format('formatblock','<h1>');" title="Überschrift 1. Ordnung">H1</button>
		<button type="button" class="html_button" onclick="format('formatblock','<h2>');" title="Überschrift 2. Ordnung">H2</button>
		<button type="button" class="html_button" onclick="format('formatblock','<h3>');" title="Überschrift 3. Ordnung">H3</button>
		<button type="button" class="html_button" onclick="format('formatblock','<h4>');" title="Überschrift 4. Ordnung">H4</button>
		<button type="button" class="html_button" onclick="format('insertunorderedlist','');" title="Unsortierte Liste">?</button>
		<button type="button" class="html_button" onclick="format('insertorderedlist','');" title="Unsortierte Liste">1.</button>
		&nbsp;
		<button type="button" class="html_button" onclick="format('inserthorizontalrule','');"  title="Trennlinie">&mdash;</button>
		<button type="button" class="html_button" onclick="format('bold','');"><b>B</b></button>
		<button type="button" class="html_button" onclick="format('italic','');"><i>I</i></button>
		<button type="button" class="html_button" onclick="format('subscript','');"><span style="font-size: 65%;"><sub>X</sub></span></button>
		<button type="button" class="html_button" onclick="format('superscript','');"><span style="font-size: 65%;"><sup>X</sup></span></button>
		<button type="button" class="html_button" onclick="document.execCommand('createlink');"><span style="text-decoration: underline;">link</span></button>
		&nbsp;
		<button type="button" class="html_button" onclick="format('justifyleft','');">|= </button>
		<button type="button" class="html_button" onclick="format('justifyright','');"> =|</button>
		<button type="button" class="html_button" onclick="format('justifycenter','');">)=(</button>
		<button type="button" class="html_button" onclick="format('justifyfull','');">|=|</button>
		&nbsp;
		<button type="button" onclick="html();">HTML</button>
		<br>
		<textarea id="textarea" style="display: none;" rows="20" cols="90"></textarea>
		<div contenteditable="true" id="inhalt" style="border: solid 1px #D0D0D0; padding: 5px; height: 350px; width: 90%; overflow: scroll;">
			<? echo $p["Inhalt"]; ?>
		</div>
		<button onclick="postEdit()" id="saveButton"><? echo $lang_save; ?></button>-->
		<textarea name="text" class="advancedEditor" rows="20" cols="90"><? echo $p["Inhalt"]; ?></textarea>
		<button onclick="postEdit()"><? echo $lang_save; ?></button>
	</form>
	
	<?
}
?>