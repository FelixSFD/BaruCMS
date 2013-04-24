<div class="contentHead">
	<h1>Men&uuml;</h1>
	<h3><a href="#">Neuen Men&uuml;punkt anlegen &raquo;</a></h3>
</div>
<script>
$(function() {
	$("#sortable").sortable();
	$("#sortable").disableSelection();
	$( ".portlet" ).addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
		.find( ".portlet-header" )
		.addClass( "ui-widget-header ui-corner-all" )
		.prepend( "<span class='ui-icon ui-icon-plusthick'></span>")
		.end()
		.find( ".portlet-content" );
	$( ".portlet" ).toggleClass( "ui-icon-minusthick" ).toggleClass( "ui-icon-plusthick" );
	$( ".portlet-header .ui-icon" ).click(function() {
		$( this ).toggleClass( "ui-icon-plusthick" ).toggleClass( "ui-icon-minusthick" );
		$( this ).parents( ".portlet:first" ).find( ".portlet-content" ).toggle();
	});
	$(".portlet-content").children(".button-edit").click(function(){
		var id = $(this).data("id");
		$("#menuEditDialog").load("backendModules/menu.baru/edit.php?menuID="+id, function(){
			$("#menuEditDialog").dialog("open");
		});
	});
	$("#menuEditDialog").dialog({
		modal: true,
		autoOpen: false,
		width: "auto",
		buttons:{
			Speichern: function(){
				$(this).dialog("close");
			}
		}
	});
});

function save(){
	var sortedIDs = $("#sortable").sortable("toArray");
	var n = 0;
	while(sortedIDs[n]){
		var linkID = sortedIDs[n];
		var position = n;
		console.log("Link "+linkID+" ist jetzt auf Position "+position);
		n++;
	}
}
</script>
 <style>
/*
#sortable {
	list-style-type: none;
	margin: 0;
	padding: 0;
	width: 60%;
	cursor: pointer;
}

#sortable li {
	margin: 0 3px 3px 3px;
	padding: 0.4em;
	padding-left: 1.5em;
	font-size: 11pt;
	height: 15px;
}

#sortable li span {
	position: absolute;
	margin-left: -1.3em;
}
*/
#sortable {
	width: 60%;
}

#sortable .portlet-header{
	cursor: move;
}
#sortable .ui-icon{
	cursor: pointer;
}

.portlet-content{
	font-size: 11pt;

}
</style>
<div id="menuEditDialog" title="Men&uuml;punkt bearbeiten"></div>
<div id="sortable">
	<?php
	$n = 0;
	$menuForm = "";
	if(!$_GET["mainMenu"]){
		$mainMenu = 0;
	} else {
		$mainMenu = $_GET["mainMenu"];
	}
	$menuQuery = $db->query("SELECT * FROM ".$db_prefix."Menu WHERE mainMenu = '".$mainMenu."'");
	while($menuResult = $menuQuery->fetch_object()){
		$n++;
		echo '
		<div id="'.$menuResult->ID .'" data-position="'.$n.'" class="portlet">
			<div class="portlet-header">'.$menuResult->Titel .'</div>
			<div class="portlet-content">
				<button class="ui-state-default ui-corner-all button-edit" data-id="'.$menuResult->ID .'">bearbeiten</button>
				<button class="ui-state-default ui-corner-all" data-id="'.$menuResult->ID .'">L&ouml;schen</button>
			</div>
		</div>
		';
		$menuForm = "";
	}
	?>
</div>
<br>
<button onclick="save()" class="ui-state-default ui-corner-all">Speichern</button>
<?php
if($_GET["mainMenu"]){
	echo '<h3><a href="javascript:history.back();">Zur&uuml;ck &raquo;</a></h3>';
}
?>