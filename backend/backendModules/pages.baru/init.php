<?php
if(getRights("EDIT_PAGES", $userinfo["Group"])){
?>
<style>
.date{
	position: relative;
	top: 0px;
	right: 0px;
	font-size: 7pt;
	color: #757575;
}
</style>
<script>
$(document).ready(function() { 
	loadList();
	loadCatList();
});

function loadList(){
	$("#list").load("backendModules/pages.baru/list.php", function(){
		$(".baruManagerItem").click(function(){
			if(pageEdited){
				pageEdited = false;
				check = confirm("M&ouml;chtest du die Seite ohne zu Speichern verlassen?");
				if(!check){
					pageEdited = true;
					return false;
				}
			}
			var pageID = $(this).data("id");
			var pageURL = $(this).data("url");
			$("#baruEditor").load("backendModules/pages.baru/editor.php?pageID="+pageID, reloadTinyMCE);
			$("#viewFrontend").click(function(){
				window.open("../"+pageURL+".html");
			});
			$("#delete").click(function(){
				deleteCheck = confirm("Soll diese Seite unwiederruflich gelöscht werden?");
				if(deleteCheck){
					var form_data = {
						id: pageID,
						is_ajax: 1
					};
					
					jQuery.ajax({
						type: "POST",
						url: "backendModules/pages.baru/delete.php",
						data: form_data,
						success: function(response)
						{
							if(response == "success"){
								//alert("Gelöscht!");
								$("#baruEditor").html("<center>Keine Seite ausgew&auml;hlt!</center>");
								setTimeout(statusReset, 2500);
								loadList();
								$("#viewFrontend").fadeOut("normal");
								$("#delete").fadeOut("normal");
								pageEdited = false;
							} else {
								var errorMsg = "Ein unbekannter Fehler ist aufgetreten!";
								alert(errorMsg);
							}
						}
					});
				}
			});
			$("#viewFrontend").fadeIn("normal");
			$("#delete").fadeIn("normal");
		});
	});
}

var pageEdited;
function reloadTinyMCE(){
	$('textarea.advancedEditor').tinymce({
		// Location of TinyMCE script
		script_url : '../system/jQuery/plugins/tinymce/jscripts/tiny_mce/tiny_mce.js',

		// General options
		theme : "advanced",
		editor_selector : "mceAdvanced",
		plugins : "jbimages,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
		language: "<? echo strtolower(getSetting("LANGUAGE")); ?>",
		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,code,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,|,fullscreen",
		theme_advanced_buttons4 : "jbimages,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		height: "100%",


		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
	$("#baruEditor").click(function(){
		pageEdited = true;
	});
}

function newPage(){
	$("#baruEditor").html('<input type="text" id="title" size="80" placeholder="&Uuml;berschrift" /><br><textarea id="inhalt" class="advancedEditor baruEditorFullSize"></textarea><br><select id="category"><option disabled selected>Kategorie w&auml;hlen</option><?php $catQuery = $db->query("SELECT * FROM ".$db_prefix."Categories ORDER BY Name");while($catResult = $catQuery->fetch_object()) {if($pagesResult->Category == $catResult->ID){echo '<option value="'.$catResult->ID .'" selected>'.$catResult->Name .'</option>';} else {echo '<option value="'.$catResult->ID .'">'.$catResult->Name .'</option>';}}?></select><br><button onclick="saveNew()" class="ui-state-default ui-corner-all">Speichern</button><span id="ajaxStatus"></span>');
	reloadTinyMCE();
}

//Speichern
function save(){
	var ajaxStatus = $("#ajaxStatus");
	ajaxStatus.html("Speichern...");
	var ed = tinyMCE.get('inhalt');
	var content = ed.getContent();
	var form_data = {
		inhalt: content,
		title: $("#title").val(),
		id: $("#id").val(),
		type: $("#type").val(),
		category: $("#category").val(),
		is_ajax: 1
	};
	
	jQuery.ajax({
		type: "POST",
		url: "backendModules/pages.baru/save.php",
		data: form_data,
		success: function(response)
		{
			if(response == "success"){
				ajaxStatus.html("Gespeichert!");
				setTimeout(statusReset, 2500);
				loadList();
				pageEdited = false;
				$("#viewFrontend").fadeIn("normal");
				$("#delete").fadeIn("normal");
			} else {
				var errorMsg = "Ein unbekannter Fehler ist aufgetreten!";
				ajaxStatus.html(errorMsg);
			}
		}
	});
	return false;
}

function saveNew(){
	var ajaxStatus = $("#ajaxStatus");
	ajaxStatus.html("Speichern...");
	var ed = tinyMCE.get('inhalt');
	var content = ed.getContent();
	var form_data = {
		inhalt: content,
		title: $("#title").val(),
		id: $("#id").val(),
		category: $("#category").val(),
		is_ajax: 1
	};
	
	jQuery.ajax({
		type: "POST",
		url: "backendModules/pages.baru/add.php",
		data: form_data,
		success: function(response)
		{
			if(response == "success"){
				ajaxStatus.html("Gespeichert!");
				setTimeout(statusReset, 2500);
				loadList();
				pageEdited = false;
			} else {
				var errorMsg = "Ein unbekannter Fehler ist aufgetreten!";
				ajaxStatus.html(errorMsg);
			}
		}
	});
	return false;
}

function statusReset(){
	var ajaxStatus = $("#ajaxStatus");
	ajaxStatus.html("");
}
</script>
<div class="contentHead">
	<h1>Inhalte</h1>
	<h3>
		<a href="#section-pages">Seiten &raquo;</a>
		<br>
		<a href="#section-categories">Kategorien &raquo;</a>
	</h3>
</div>
<h2 id="section-pages">Seiten <small class="link-top"><a href="#top">&#8593; top &#8593;</a></small></h2>
<h3><a href="javascript:void(0);" onclick="newPage()">Neue Seite anlegen &raquo;</a></h3>
<table id="baruManager" class="zebra">
	<thead>
		<th width="30%">Seiten</th>
		<th>Editor <span id="editorButtons"><button id="delete" class="ui-state-default ui-corner-all" style="display: none;">L&ouml;schen</button>&nbsp;<button id="viewFrontend" class="ui-state-default ui-corner-all" style="display: none;">Im Frontend ansehen</button></span></th>
	</thead>
	<tbody valign="top">
		<tr>
			<td id="list">
				<!-- Seitenliste -->
				<!--<div class="baruManagerItem">
					<b>titel der Seite</b>
					<p>Kurze Vorschau...</p>
				</div>-->
				Wird geladen...
			</td>
			<td id="baruEditor">
				<!-- Editor -->
				<center>Keine Seite ausgew&auml;hlt!</center>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>

<h2 id="section-categories">Kategorien <small class="link-top"><a href="#top">&#8593; top &#8593;</a></small></h2>
<h3><a href="javascript:void(0);" onclick="newCategory()">Neue Kategorie anlegen &raquo;</a></h3>
<script>
function loadCatList(){
	$("#catList").load("backendModules/pages.baru/categoriesList.php", function(){
		$(".baruManagerCatItem").click(function(){
			var catID = $(this).data("id");
			var catURL = $(this).data("url");
			$("#baruCatEditor").load("backendModules/pages.baru/categoriesEditor.php?catID="+catID, function(){
				$("#deleteCat").fadeIn("normal");
			});
		});
		$("#deleteCat").click(function(){
			deleteCheck = confirm("Soll diese Kategorie unwiederruflich gelöscht werden?");
			if(deleteCheck){
				var form_data = {
					id: $("#catID").val(),
					is_ajax: 1
				};
				
				jQuery.ajax({
					type: "POST",
					url: "backendModules/pages.baru/categoriesDelete.php",
					data: form_data,
					success: function(response)
					{
						if(response == "success"){
							$("#baruCatEditor").html("<center>Keine Kategorie ausgew&auml;hlt!</center>");
							setTimeout(statusReset, 2500);
							loadCatList();
							$("#deleteCat").fadeOut("normal");
						} else {
							var errorMsg = "Ein unbekannter Fehler ist aufgetreten!";
							alert(errorMsg);
						}
					}
				});
			}
		});
	});
}

function saveCat(){
	var ajaxStatus = $("#ajaxStatusCat");
	ajaxStatus.html("Speichern...");
	var form_data = {
		name: $("#name").val(),
		id: $("#catID").val(),
		url: $("#url").val(),
		visibility: $("#visibility").val(),
		is_ajax: 1
	};
	
	jQuery.ajax({
		type: "POST",
		url: "backendModules/pages.baru/categoriesSave.php",
		data: form_data,
		success: function(response)
		{
			if(response == "success"){
				ajaxStatus.html("Gespeichert!");
				setTimeout(statusReset, 2500);
				loadCatList();
			} else {
				var errorMsg = "Ein unbekannter Fehler ist aufgetreten!";
				ajaxStatus.html(errorMsg);
			}
		}
	});
	return false;
}

function saveNewCat(){
	var ajaxStatus = $("#ajaxStatusC");
	ajaxStatus.html("Speichern...");
	var form_data = {
		name: $("#name").val(),
		is_ajax: 1
	};
	
	jQuery.ajax({
		type: "POST",
		url: "backendModules/pages.baru/categoriesAdd.php",
		data: form_data,
		success: function(response)
		{
			if(response == "success"){
				ajaxStatus.html("Gespeichert!");
				setTimeout(statusResetC, 2500);
				loadCatList();
				pageEdited = false;
			} else {
				var errorMsg = "Ein unbekannter Fehler ist aufgetreten!";
				ajaxStatus.html(errorMsg);
			}
		}
	});
	return false;
}

function statusResetC(){
	var ajaxStatus = $("#ajaxStatusC");
	ajaxStatus.html("");
}

function newCategory(){
	$("#baruCatEditor").html('<input type="text" id="name" placeholder="Name" /><br><button onclick="saveNewCat()" class="ui-state-default ui-corner-all">Speichern</button><span id="ajaxStatusC"></span>');
}
</script>
<table id="baruCatManager" class="zebra">
	<thead>
		<th width="30%">Kategorien</th>
		<th><button id="deleteCat" class="ui-state-default ui-corner-all" style="display: none;">L&ouml;schen</button></th>
	</thead>
	<tbody valign="top">
		<tr>
			<td id="catList">
				<!-- Kategorienliste -->
				<!--<div class="baruManagerItem">
					<b>titel der Seite</b>
					<p>Kurze Vorschau...</p>
				</div>-->
				Wird geladen...
			</td>
			<td id="baruCatEditor">
				<!-- Editor -->
				<center>Keine Kategorie ausgew&auml;hlt!</center>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
<?php
} else { //EDIT_PAGES
	echo errorcode(403, true);
}
?>