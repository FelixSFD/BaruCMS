<h1><? echo $lang_adminMenueElementUser; ?></h1>
<?
if(!$_GET["user"] && !$_GET["new"] && !$_GET["action"]){
	?>
	<div id="deleteDialog" title="<? echo $lang_confirmDeleteUser; ?>">
		<h3><? echo $lang_confirmDeleteUser1; ?> "<span id="userName" style="font-style: italic;"></span>" <? echo $lang_confirmDeleteUser2; ?>?</h3>
	</div>
	<div id="delLoader">
	</div>
	<script>
	function delUser(uID, uName){
		$("#deleteDialog").dialog("open");
		$("#userName").html(uName);
		
		var buttons = $("#deleteDialog").dialog("option", "buttons");
		$("#deleteDialog").dialog("option", "buttons", [
			{
				text: "<? echo $lang_deleteUser; ?>",
				click: function() {
					$(this).dialog("close");
					document.location.href = "admin.php?p=user&delete=true&uID="+uID;
				}
			}
		] );
	}
	
	function newUser(){
		document.location.href = "admin.php?p=user&new=true";
	}
	
	function editUser(uID){
		document.location.href = "admin.php?p=user&user="+uID;
	}
	
	function blockUser(uID){
		document.location.href = "admin.php?p=user&block=true&uID="+uID;
	}
	function unblockUser(uID){
		document.location.href = "admin.php?p=user&unblock=true&uID="+uID;
	}
	</script>
	<h2><? echo $lang_adminbereichUserList; ?></h2>
	<?
	if($_GET["delete"] == true){
		mysql_query("DELETE FROM `".$db_prefix."User` WHERE ID = ".$_GET["uID"], $mysql);
		hinweis($lang_userDeleted);
		?>
		<script>
		function weiterleitung(){
			document.location.href = "?p=user";
		}
		setTimeout(weiterleitung, 2200);
		</script>
		<?
	}
	if($_GET["block"] == true){
		mysql_query("UPDATE `".$db_prefix."User` SET `Status` = '0' WHERE ID = ".$_GET["uID"], $mysql);
		hinweis($lang_userBlocked);
		?>
		<script>
		function weiterleitung(){
			document.location.href = "?p=user";
		}
		setTimeout(weiterleitung, 2200);
		</script>
		<?
	}
	if($_GET["unblock"] == true){
		mysql_query("UPDATE `".$db_prefix."User` SET `Status` = '1' WHERE ID = ".$_GET["uID"], $mysql);
		hinweis($lang_userActivated);
		?>
		<script>
		function weiterleitung(){
			document.location.href = "?p=user";
		}
		setTimeout(weiterleitung, 2200);
		</script>
		<?
	}
	
	if($ECM["rights"]["ADD_USER"]){
		?>
		<div id="userNewLink" class="right">
			<button class="ui-state-default ui-corner-all right" onclick="newUser()"><? echo $lang_newUser; ?></button>
		</div>
		<?
	}
	?>
	<br><br>
	<div class="clear"></div>
	<table id="userList">
	<thead>
		<td>ID</td>
    	<td><? echo $lang_vorname; ?></td>
    	<td><? echo $lang_nachname; ?></td>
        <td><? echo $lang_email; ?></td>
        <td><? echo $lang_group; ?></td>
		<td><? echo $lang_actions; ?></td>
    </thead>
    <?
	$user = mysql_query("SELECT * FROM ".$db_prefix."User", $mysql);
	echo mysql_error();
	while ($u = mysql_fetch_array($user)) {
		if($u["Aktiviert"] != "1"){
			$status = "nicht aktiviert";
		} else {
			$status = "aktiviert";
		}
		?>
        <tr>
        	<td><? echo $u["ID"]; ?></td>
			<td><? echo $u["Vorname"]; ?></td>
        	<td><? echo $u["Nachname"]; ?></td>
			<td><? echo $u["Email"]; ?></td>
        	<td>
			<?
			$usergroup = mysql_query("SELECT * FROM ".$db_prefix."Groups WHERE ID = ".$u["Group"], $mysql);
			echo mysql_error();
			$userG = mysql_fetch_array($usergroup);
			echo $userG["Name"];
			?>
			</td>
			<td>
				<?
				if($ECM["rights"]["DELETE_USER"]){
					?>
					<button class="ui-state-default ui-corner-all right" onclick="delUser('<? echo $u["ID"]; ?>', '<? echo $u["Vorname"]." ".$u["Nachname"]; ?>')"><? echo $lang_delete; ?></button>
					<?
				}
				
				if($ECM["rights"]["EDIT_USER"]){
					if($u["Status"] == "1" && $u["ID"] != "1"){
						?>
						<button class="ui-state-default ui-corner-all right" onclick="blockUser('<? echo $u["ID"]; ?>')">[<? echo $lang_userBlock; ?>]</button>
						<?
					} else if($u["ID"] != "1"){
						?>
						<button class="ui-state-default ui-corner-all right" onclick="unblockUser('<? echo $u["ID"]; ?>')">[<? echo $lang_userActivate; ?>]</button>
						<?
					} else {
						?>
						<button class="ui-state-default ui-corner-all right" disabled>[<? echo $lang_userBlock; ?>]</button>
						<?
					}
					?>
					<button class="ui-state-default ui-corner-all right" onclick="editUser('<? echo $u["ID"]; ?>')"><? echo $lang_edit; ?></button>
					<?
				}
				?>
			</td>
        </tr>
        <?
	}
	?>
</table>
	<?
	//fehler("<h1>Nächster Schritt:</h1>Neuer User!");
} else if(!$_GET["user"] && $_GET["new"]){
	if($ECM["rights"]["ADD_USER"]){
		?>
		<script>
		createLinkBack("?p=user");
		
		function generatePW(){
			var pw = "";
			zeichen = new Array("1","2","3","4","5","6","7","8","9","0","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","!","%","&","/","+","*","?","@","#");
			var length = 0;
			while(length <= 8){
				var zufall = Math.round(Math.random()*70);
				//pw = pw+"\n"+zeichen[zufall]+"("+zufall+")";
				pw = pw+zeichen[zufall];
				length++;
			}
			//alert(pw);
			$("#pw").val(pw);
			$("#autoPwHinweis").html("<? echo $lang_autoPwHinweisText; ?>: <b>"+pw+"</b>");
			$("#autoPwHinweis").addClass("ui-state-highlight ui-corner-all");
			$("#autoPwHinweis").fadeIn("normal");
		}
		
		function hinweisWeg(){
			$("#autoPwHinweis").fadeOut("normal");
		}
		</script>
		<h2>Neuen Benutzer anlegen</h2>
		<div id="newUserForm">
			<form method="post" action="?p=user&action=new">
				<table>
					<tr>
						<td><? echo $lang_vorname; ?></td>
						<td><input type="text" name="vorname" placeholder="<? echo $lang_vorname; ?>"></td>
					</tr>
					<tr>
						<td><? echo $lang_nachname; ?></td>
						<td><input type="text" name="nachname" placeholder="<? echo $lang_nachname; ?>"></td>
					</tr>
					<tr>
						<td><? echo $lang_email; ?></td>
						<td><input type="email" name="email" placeholder="<? echo $lang_email; ?>"></td>
					</tr>
					<tr>
						<td><? echo $lang_passwort; ?></td>
						<td><input id="pw" onfocus="hinweisWeg()" type="password" name="pw" placeholder="<? echo $lang_passwort; ?>"></td>
						<td><a id="pwGenerator" onclick="generatePW()" href="#"><? echo $lang_zPasswort; ?></a></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="<? echo $lang_save; ?>"></td>
					</tr>
				</table>
				<div id="autoPwHinweis" style="display: none; width: 500px;"></div>
			</form>
		</div>
		<?
	} else {
		fehler($lang_noPermission);
	}
} else if($_GET["action"] == "new" && $ECM["rights"]["ADD_USER"]){
	mysql_query("INSERT INTO `".$db_prefix."User` VALUES ('', '".$_POST["vorname"]."', '".$_POST["nachname"]."', '".$_POST["email"]."', '".md5($_POST["pw"])."', '0', '1')", $mysql);
	?>
	<script>
	function weiterleitung(){
		document.location.href = "?p=user";
	}
	setTimeout(weiterleitung, 2500);
	</script>
	<?
	if(mysql_error()){
		fehler(mysql_error());
	} else {
		hinweis($lang_userSaved);
	}
} else if($_GET["user"] > 0){
	?>
	<h2><? echo $lang_editUserTitle; ?></h2>
	<?
	if($_GET["action"] == "save" && $ECM["rights"]["EDIT_USER"]){
		mysql_query("UPDATE `".$db_prefix."User` SET `Vorname` = '".$_POST["vorname"]."' WHERE ID = ".$_GET["user"], $mysql);
		mysql_query("UPDATE `".$db_prefix."User` SET `Nachname` = '".$_POST["nachname"]."' WHERE ID = ".$_GET["user"], $mysql);
		mysql_query("UPDATE `".$db_prefix."User` SET `Email` = '".$_POST["email"]."' WHERE ID = ".$_GET["user"], $mysql);
		if($_POST["pw"]){
			if($ECM["userID"] == $_GET["user"] or $ECM["rights"]["EDIT_USER_PW"]){
				mysql_query("UPDATE `".$db_prefix."User` SET `Passwort` = '".md5($_POST["pw"])."' WHERE ID = ".$_GET["user"], $mysql);
			}
		}
		mysql_query("UPDATE `".$db_prefix."User` SET `Group` = '".$_POST["group"]."' WHERE ID = ".$_GET["user"], $mysql);
		hinweis($lang_userSaved);
	} else if($_GET["action"] == "save"){
		fehler($lang_noPermission);
	}
	
	$user = mysql_query("SELECT * FROM ".$db_prefix."User WHERE ID = ".$_GET["user"], $mysql);
	if(mysql_error()){
		fehler(mysql_error());
	}
	$u = mysql_fetch_array($user);
	
	if($ECM["rights"]["EDIT_USER"]){
		?>
		<script>
		createLinkBack("?p=user");
		</script>
		<div id="editUserForm">
			<form method="post" action="?p=user&user=<? echo $_GET["user"]; ?>&action=save">
				<table>
					<tr>
						<td><? echo $lang_vorname; ?>:</td>
						<td><input type="text" name="vorname" value="<? echo $u["Vorname"]; ?>" placeholder="<? echo $lang_vorname; ?>"></td>
					</tr>
					<tr>
						<td><? echo $lang_nachname; ?>:</td>
						<td><input type="text" name="nachname" value="<? echo $u["Nachname"]; ?>" placeholder="<? echo $lang_nachname; ?>"></td>
					</tr>
					<tr>
						<td><? echo $lang_email; ?>:</td>
						<td><input type="email" name="email" value="<? echo $u["Email"]; ?>" placeholder="<? echo $lang_email; ?>"></td>
					</tr>
					<?
					if($_GET["user"] == $ECM["userID"] or $ECM["rights"]["EDIT_USER_PW"]){
						?>
						<tr>
							<td><? echo $lang_password; ?>:</td>
							<td><input type="password" name="pw" placeholder="<? echo $lang_password; ?>"></td>
						</tr>
						<?
					}
					?>
					<tr>
						<td><? echo $lang_group; ?>:</td>
						<td>
						<select name="group">
							<?
							$groups = mysql_query("SELECT * FROM ".$db_prefix."Groups", $mysql);
							echo mysql_error();
							while ($g = mysql_fetch_array($groups)) {
								?>
								<option value="<? echo $g["ID"]; ?>"><? echo $g["Name"]; ?></option>
								<?
							}
							?>
						</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="<? echo $lang_save; ?>"></td>
					</tr>
				</table>
				<div id="autoPwHinweis" style="display: none; width: 500px;"></div>
			</form>
		</div>
		<?
	} else {
		fehler($lang_noPermission);
	}
}
?>