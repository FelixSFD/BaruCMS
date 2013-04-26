<?php
if(getRights("EDIT_USER", $userinfo["Group"])){
?>
<div class="contentHead">
	<h1>Benutzer</h1>
	<h3>
		<a href="#section-userlist">Benutzerliste &raquo;</a>
		<br>
		<a href="#section-usergroups">Benutzergruppen &raquo;</a>
	</h3>
</div>
<script>
$(document).ready(function() { 
	loadList();
	loadList2();
});

function loadList(){
	$("#list").load("backendModules/members.baru/list.php", function(){
		$(".baruManagerItem").click(function(){
			var userID = $(this).data("id");
			$("#baruEditor").load("backendModules/members.baru/editor.php?userID="+userID, function(){
				$("#delete").fadeIn("normal");
			});
			$("#delete").click(function(){
				deleteCheck = confirm("Soll dieser Benutzer unwiederruflich gelöscht werden?");
				if(deleteCheck){
					var form_data = {
						id: userID,
						is_ajax: 1
					};
					
					jQuery.ajax({
						type: "POST",
						url: "backendModules/members.baru/delete.php",
						data: form_data,
						success: function(response)
						{
							if(response == "success"){
								//alert("Gelöscht!");
								$("#baruEditor").html("<center>Kein Benutzer ausgew&auml;hlt!</center>");
								setTimeout(statusReset, 2500);
								loadList();
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
		});
	});
}


function newUser(){
	$("#baruEditor").load('backendModules/members.baru/new.html');
}

//Speichern
function save(){
	var ajaxStatus = $("#ajaxStatus");
	ajaxStatus.html("Speichern...");
	var form_data = {
		user: $("#id").val(),
		vorname: $("#vorname").val(),
		nachname: $("#nachname").val(),
		email: $("#email").val(),
		pw: $("#pw").val(),
		group: $("#group").val(),
		is_ajax: 1
	};
	
	jQuery.ajax({
		type: "POST",
		url: "backendModules/members.baru/save.php",
		data: form_data,
		success: function(response)
		{
			if(response == "success"){
				ajaxStatus.html("Gespeichert!");
				setTimeout(statusReset, 2500);
				loadList();
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
	var form_data = {
		user: $("#id").val(),
		vorname: $("#vorname").val(),
		nachname: $("#nachname").val(),
		email: $("#email").val(),
		pw: $("#pw").val(),
		is_ajax: 1
	};
	
	jQuery.ajax({
		type: "POST",
		url: "backendModules/members.baru/add.php",
		data: form_data,
		success: function(response)
		{
			if(response == "success"){
				ajaxStatus.html("Gespeichert!");
				$("#baruEditor").html("<center>Kein Benutzer ausgew&auml;hlt!</center>");
				setTimeout(statusReset, 2500);
				loadList();
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

function generatePW(){
	var pw = "";
	zeichen = new Array("1","2","3","4","5","6","7","8","9","0","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","!","%","&","/","+","*","?","@","#");
	var length = 0;
	while(length <= 8){
		var zufall = Math.round(Math.random()*70);
		pw = pw+zeichen[zufall];
		length++;
	}
	$("#pw").val(pw);
	$("#autoPwHinweis").html("Das zuf&auml;llig generierte Passwort lautet: <b>"+pw+"</b>");
	$("#autoPwHinweis").addClass("ui-state-highlight ui-corner-all");
	$("#autoPwHinweis").fadeIn("normal");
}
</script>
<h2 id="section-userlist">Benutzerliste <small class="link-top"><a href="#top">&#8593; top &#8593;</a></small></h2>
<h3><a href="javascript:void(0)" onclick="newUser()">Neuen Benutzer anlegen &raquo;</a></h3>
<table id="baruManager" class="zebra">
	<thead>
		<th width="30%">Benutzer</th>
		<th><span id="editorButtons"><button id="delete" class="ui-state-default ui-corner-all" style="display: none;">L&ouml;schen</button></span></th>
	</thead>
	<tbody valign="top">
		<tr>
			<td id="list">
				<!-- Userliste -->
				<!--<div class="baruManagerItem">
					<b>Username</b>
					<p>Gruppe</p>
				</div>-->
				Wird geladen...
			</td>
			<td id="baruEditor">
				<!-- User-Ansicht -->
				<center>Kein Benutzer ausgew&auml;hlt!</center>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
<script>
function newUsergroup(){
	$("#baruEditor2").load('backendModules/members.baru/groupNew.html');
}

function loadList2(){
	$("#list2").load("backendModules/members.baru/list.php?type=groups", function(){
		$(".baruManagerItemGroups").click(function(){
			var groupID = $(this).data("id");
			$("#baruEditor2").load("backendModules/members.baru/groupEditor.php?groupID="+groupID, function(){
				$("#deleteGroup").fadeIn("normal");
			});
		});
		$("#deleteGroup").click(function(){
			deleteCheck = confirm("Soll dieser Benutzer unwiederruflich gelöscht werden?");
			if(deleteCheck){
				var form_data = {
					id: $("#groupID").val(),
					is_ajax: 1
				};
				
				jQuery.ajax({
					type: "POST",
					url: "backendModules/members.baru/groupDelete.php",
					data: form_data,
					success: function(response)
					{
						if(response == "success"){
							//alert("Gelöscht!");
							$("#baruEditor2").html("<center>Keine Benutzergruppe ausgew&auml;hlt!</center>");
							setTimeout(statusReset, 2500);
							loadList2();
							$("#deleteGroup").fadeOut("normal");
							pageEdited = false;
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

function saveNewGroup(){
	var ajaxStatus = $("#ajaxStatus2");
	ajaxStatus.html("Speichern...");
	var form_data = {
		name: $("#gName").val(),
		is_ajax: 1
	};
	
	jQuery.ajax({
		type: "POST",
		url: "backendModules/members.baru/groupAdd.php",
		data: form_data,
		success: function(response)
		{
			if(response == "success"){
				ajaxStatus.html("Gespeichert!");
				$("#baruEditor2").html("<center>Keine Benutzergruppe ausgew&auml;hlt!</center>");
				setTimeout(statusReset, 2500);
				loadList2();
			} else {
				var errorMsg = "Ein unbekannter Fehler ist aufgetreten!";
				ajaxStatus.html(errorMsg);
			}
		}
	});
	return false;
}

function saveGroup(){
	var ajaxStatus = $("#ajaxStatus2");
	ajaxStatus.html("Speichern...");
	if(document.getElementById("EDIT_USER").checked){
		var edit_user = true;
	}
	if(document.getElementById("EDIT_USERGROUPS").checked){
		var edit_usergroups = true;
	}
	if(document.getElementById("EDIT_PAGES").checked){
		var edit_pages = true;
	}
	if(document.getElementById("UPDATE_SETTINGS").checked){
		var update_settings = true;
	}
	if(document.getElementById("UPDATE_SYSTEM").checked){
		var update_system = true;
	}
	if(document.getElementById("VIEW_SYSTEM_INFO").checked){
		var view_system_info = true;
	}
	var form_data = {
		groupID: $("#groupID").val(),
		EDIT_USER: edit_user,
		EDIT_USERGROUPS: edit_usergroups,
		EDIT_PAGES: edit_pages,
		UPDATE_SETTINGS: update_settings,
		UPDATE_SYSTEM: update_system,
		VIEW_SYSTEM_INFO: view_system_info,
		is_ajax: 1
	};
	
	jQuery.ajax({
		type: "POST",
		url: "backendModules/members.baru/saveGroups.php",
		data: form_data,
		success: function(response)
		{
			if(response == "success"){
				ajaxStatus.html("Gespeichert!");
				setTimeout(statusReset, 2500);
				loadList();
			} else {
				var errorMsg = "Ein unbekannter Fehler ist aufgetreten!";
				ajaxStatus.html(errorMsg);
			}
		}
	});
	return false;
}
</script>
<?php
if(getRights("EDIT_USERGROUPS", $userinfo["Group"])){
?>
<h2 id="section-usergroups">Benutzergruppen <small class="link-top"><a href="#top">&#8593; top &#8593;</a></small></h2>
<h3><a href="javascript:void(0)" onclick="newUsergroup()">Neue Benutzergruppe anlegen &raquo;</a></h3>
<table id="baruManager2" class="zebra">
	<thead>
		<th width="30%">Gruppen</th>
		<th><span id="editorButtons2"><button id="deleteGroup" class="ui-state-default ui-corner-all" style="display: none;">L&ouml;schen</button></span></th>
	</thead>
	<tbody valign="top">
		<tr>
			<td id="list2">
				<!-- Userliste -->
				<!--<div class="baruManagerItem">
					<b>Gruppenname</b>
				</div>-->
				Wird geladen...
			</td>
			<td id="baruEditor2">
				<!-- User-Ansicht -->
				<center>Keine Benutzergruppe ausgew&auml;hlt!</center>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
<?php
} //EDIT_USERGROUPS

} else { //EDIT_USER
	echo errorcode(403, true);
}
?>