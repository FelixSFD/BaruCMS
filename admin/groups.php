<h1><? echo $lang_adminbereichUserGroups; ?></h1>
<?
if($ECM["rights"]["MANAGE_GROUPS"]){
?>
<script>
function delGroup(gID, gName){
	$("#deleteDialog").dialog("open");
	$("#groupName").html(gName);
	
	var buttons = $("#deleteDialog").dialog("option", "buttons");
	$("#deleteDialog").dialog("option", "buttons", [
		{
			text: "<? echo $lang_deleteGroup; ?>",
			click: function() {
				$(this).dialog("close");
				document.location.href = "admin.php?p=usergroups&delete=true&gID="+gID;
			}
		}
	] );
}
	
function newGroup(){
	document.location.href = "?p=usergroups&new=true";
}

function editGroup(gID){
	document.location.href = "admin.php?p=usergroups&group="+gID;
}
</script>
<div id="deleteDialog" title="<? echo $lang_confirmDeleteGroup; ?>">
	<h3><? echo $lang_confirmDeleteGroup1; ?> "<span id="groupName" style="font-style: italic;"></span>" <? echo $lang_confirmDeleteGroup2; ?>?</h3>
</div>
<?
if($_POST["name"]){
	mysql_query("INSERT INTO `".$db_prefix."Groups` VALUES ('', '".$_POST["name"]."')", $mysql);
}

if(!$_GET["group"] && !$_GET["new"]){
	if($_GET["delete"] && $ECM["rights"]["MANAGE_GROUPS"]){
		mysql_query("DELETE FROM `".$db_prefix."Groups` WHERE ID = ".$_GET["gID"], $mysql);
		hinweis($lang_groupDeleted);
	}
	?>
	<button class="ui-state-default ui-corner-all right" onclick="newGroup()"><? echo $lang_newGroup; ?></button>
	<br><br>
	<table id="groupsList">
		<thead>
			<td>ID</td>
			<td><? echo $lang_groupName; ?></td>
			<td><? echo $lang_actions; ?></td>
		</thead>
		<?
		$groups = mysql_query("SELECT * FROM ".$db_prefix."Groups", $mysql);
		echo mysql_error();
		while ($g = mysql_fetch_array($groups)) {
		?>
		<tr>
			<td><? echo $g["ID"]; ?></td>
			<td><? echo $g["Name"]; ?></td>
			<td>
				<button class="ui-state-default ui-corner-all right" onclick="delGroup('<? echo $g["ID"]; ?>', '<? echo $g["Name"]; ?>')"><? echo $lang_delete; ?></button>
				<button class="ui-state-default ui-corner-all right" onclick="editGroup('<? echo $g["ID"]; ?>')"><? echo $lang_edit; ?></button>
			</td>
		</tr>
		<?
	}
	?>
	</table>
	<?
} else if($_GET["new"] == true){
	?>
	<script>
	createLinkBack("?p=usergroups");
	</script>
	<h2><? echo $lang_addGroup; ?></h2>
	<form method="post" action="?p=usergroups">
		<? echo $lang_groupName; ?>:
		<input type="text" name="name" placeholder="<? echo $lang_groupName; ?>"><button type="submit"><? echo $lang_save; ?></button>
	</form>
	<?
} else if($_GET["group"]){
	echo "<h2>".$lang_editGroup."</h2>";
	
	// pages
	if($_GET["save"] == "pages"){
		// ADD_PAGE
		if($_POST["add_page"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_PAGE' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'ADD_PAGE', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'ADD_PAGE' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		//EDIT_PAGE
		if($_POST["edit_page"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_PAGE' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'EDIT_PAGE', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'EDIT_PAGE' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		//DELETE_PAGE
		if($_POST["delete_page"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'DELETE_PAGE' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'DELETE_PAGE', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'DELETE_PAGE' AND GroupID = ".$_GET["group"], $mysql);
		}
	}
	
	//user
	if($_GET["save"] == "user"){
		// ADD_USER
		if($_POST["add_user"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_USER' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'ADD_USER', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'ADD_USER' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		//EDIT_USER
		if($_POST["edit_user"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_USER' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'EDIT_USER', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'EDIT_USER' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		//EDIT_USER_PW
		if($_POST["edit_user_pw"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_USER_PW' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'EDIT_USER_PW', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'EDIT_USER_PW' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		//DELETE_USER
		if($_POST["delete_user"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'DELETE_USER' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'DELETE_USER', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'DELETE_USER' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		//MANAGE_GROUPS
		if($_POST["manage_groups"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'MANAGE_GROUPS' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'MANAGE_GROUPS', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'MANAGE_GROUPS' AND GroupID = ".$_GET["group"], $mysql);
		}
	}
	
	//files
	if($_GET["save"] == "files"){
		// ADD_FILE
		if($_POST["add_file"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_FILE' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'ADD_FILE', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'ADD_FILE' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		// ADD_FOLDER
		if($_POST["add_folder"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_FOLDER' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'ADD_FOLDER', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'ADD_FILE' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		//DELETE_FILE
		if($_POST["delete_file"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'DELETE_FILE' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'DELETE_FILE', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'DELETE_FILE' AND GroupID = ".$_GET["group"], $mysql);
		}
	}
	
	//more
	if($_GET["save"] == "more"){
		// EDIT_STYLE
		if($_POST["edit_style"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_STYLE' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'EDIT_STYLE', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'EDIT_STYLE' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		//EDIT_GENERAL_SETTINGS
		if($_POST["edit_general_settings"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_GENERAL_SETTINGS' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'EDIT_GENERAL_SETTINGS', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'EDIT_GENERAL_SETTINGS' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		//UPDATE_SYSTEM
		if($_POST["update_system"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'UPDATE_SYSTEM' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'UPDATE_SYSTEM', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'UPDATE_SYSTEM' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		//VIEW_SYSTEM_INFO
		if($_POST["view_system_info"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'VIEW_SYSTEM_INFO' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'VIEW_SYSTEM_INFO', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'VIEW_SYSTEM_INFO' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		//MANAGE_PLUGINS
		if($_POST["manage_plugins"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'MANAGE_PLUGINS' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'MANAGE_PLUGINS', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'MANAGE_PLUGINS' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		//MANAGE_TEMPLATES
		if($_POST["manage_templates"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'MANAGE_TEMPLATES' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'MANAGE_TEMPLATES', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'MANAGE_TEMPLATES' AND GroupID = ".$_GET["group"], $mysql);
		}
	}
	
	//menu
	if($_GET["save"] == "menu"){
		// ADD_MENU
		if($_POST["add_menu"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_MENU' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'ADD_MENU', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'ADD_MENU' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		//EDIT_MENU
		if($_POST["edit_menu"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_MENU' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'EDIT_MENU', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'EDIT_MENU' AND GroupID = ".$_GET["group"], $mysql);
		}
		
		//DELETE_MENU
		if($_POST["delete_menu"]){
			$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'DELETE_MENU' AND GroupID = ".$_GET["group"], $mysql);
			echo mysql_error();
			$r = mysql_fetch_array($rights);
			if($r["ID"]){
				// nichts verändern
			} else {
				// neu hinzufügen
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'DELETE_MENU', '".$_GET["group"]."')", $mysql);
				if(mysql_error()){
					fehler(mysql_error());
				}
			}
		} else {
			// löschen
			mysql_query("DELETE FROM `".$db_prefix."Rights` WHERE Name = 'DELETE_MENU' AND GroupID = ".$_GET["group"], $mysql);
		}
	}
	?>
	<script>
	createLinkBack("?p=usergroups");
	</script>
	<div id="accordion">
		<h2><a href="#"><? echo $lang_adminMenueElementPages; ?></a></h2>
		<div>
			<form method="post" action="?p=usergroups&group=<? echo $_GET["group"]; ?>&save=pages">
				<table>
					<tr>
						<td><label for="add_page">ADD_PAGE</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_PAGE' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="add_page" id="add_page" value="add_page" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="edit_page">EDIT_PAGE</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_PAGE' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="edit_page" id="edit_page" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="delete_page">DELETE_PAGE</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'DELETE_PAGE' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="delete_page" id="delete_page" <? echo $checked; ?> /></td>
					</tr>
				</table>
				<button type="submit"><? echo $lang_save; ?></button>
			</form>
		</div>
		<h2><a href="#"><? echo $lang_adminMenueElementUser; ?></a></h2>
		<div>
			<form method="post" action="?p=usergroups&group=<? echo $_GET["group"]; ?>&save=user">
				<table>
					<tr>
						<td><label for="add_user">ADD_USER</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_USER' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="add_user" id="add_user" value="add_user" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="edit_user">EDIT_USER</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_USER' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="edit_user" id="edit_user" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="edit_user_pw">EDIT_USER_PW</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_USER_PW' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="edit_user_pw" id="edit_user_pw" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="delete_user">DELETE_USER</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'DELETE_USER' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="delete_user" id="delete_user" value="delete_user" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="manage_groups">MANAGE_GROUPS</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'MANAGE_GROUPS' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="manage_groups" id="manage_groups" value="manage_groups" <? echo $checked; ?> /></td>
					</tr>
				</table>
				<button type="submit"><? echo $lang_save; ?></button>
			</form>
		</div>
		<h2><a href="#"><? echo $lang_adminMenueElementMenu; ?></a></h2>
		<div>
			<form method="post" action="?p=usergroups&group=<? echo $_GET["group"]; ?>&save=menu">
				<table>
					<tr>
						<td><label for="add_menu">ADD_MENU</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_MENU' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="add_menu" id="add_menu" value="add_menu" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="edit_menu">EDIT_MENU</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_MENU' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="edit_menu" id="edit_menu" value="delete_menu" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="delete_menu">DELETE_MENU</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'DELETE_MENU' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="delete_menu" id="delete_menu" value="delete_menu" <? echo $checked; ?> /></td>
					</tr>
				</table>
				<button type="submit"><? echo $lang_save; ?></button>
			</form>
		</div>
		<h2><a href="#"><? echo $lang_adminMenueElementFiles; ?></a></h2>
		<div>
			<form method="post" action="?p=usergroups&group=<? echo $_GET["group"]; ?>&save=files">
				<table>
					<tr>
						<td><label for="add_file">ADD_FILE</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_FILE' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="add_file" id="add_file" value="add_file" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="add_folder">ADD_FOLDER</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'ADD_FOLDER' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="add_folder" id="add_folder" value="add_folder" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="delete_file">DELETE_FILE</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'DELETE_FILE' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="delete_file" id="delete_file" value="delete_file" <? echo $checked; ?> /></td>
					</tr>
				</table>
				<button type="submit"><? echo $lang_save; ?></button>
			</form>
		</div>
		<h2><a href="#"><? echo $lang_adminMenueElementMore; ?></a></h2>
		<div>
			<form method="post" action="?p=usergroups&group=<? echo $_GET["group"]; ?>&save=more">
				<table>
					<tr>
						<td><label for="edit_style">EDIT_STYLE</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_STYLE' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="edit_style" id="edit_style" value="edit_style" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="edit_general_settings">EDIT_GENERAL_SETTINGS</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'EDIT_GENERAL_SETTINGS' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="edit_general_settings" id="edit_general_settings" value="edit_general_settings" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="update_system">UPDATE_SYSTEM</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'UPDATE_SYSTEM' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="update_system" id="update_system" value="update_system" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="view_system_info">VIEW_SYSTEM_INFO</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'VIEW_SYSTEM_INFO' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="view_system_info" id="view_system_info" value="view_system_info" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="manage_plugins">MANAGE_PLUGINS</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'MANAGE_PLUGINS' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="manage_plugins" id="manage_plugins" value="manage_plugins" <? echo $checked; ?> /></td>
					</tr>
					<tr>
						<td><label for="manage_templates">MANAGE_TEMPLATES</label></td>
						<?
						$checked = "";
						$rights = mysql_query("SELECT * FROM ".$db_prefix."Rights WHERE Name = 'MANAGE_TEMPLATES' AND GroupID = ".$_GET["group"], $mysql);
						echo mysql_error();
						$r = mysql_fetch_array($rights);
						if($r["ID"]){
							$checked = "checked='checked'";
						}
						?>
						<td><input type="checkbox" class="checkbox" name="manage_templates" id="manage_templates" value="manage_templates" <? echo $checked; ?> /></td>
					</tr>
				</table>
				<button type="submit"><? echo $lang_save; ?></button>
			</form>
		</div>
	</div>
	<?
}


//ENDE
} else {
	fehler($lang_noPermission);
}
?>