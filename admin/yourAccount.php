<h1>Dein Account</h1>
<h2>Mit Facebook verbinden</h2>
<?php
if(user_FB($baru["userID"])){
	?>
	<table>
		<tr>
			<td><b>ID:</b></td>
			<td class="facebook-id">Wird geladen...</td>
		</tr>
		<tr>
			<td><b>Name:</b></td>
			<td class="facebook-name">Wird geladen...</td>
		</tr>
		<tr>
			<td><b>E-Mail:</b></td>
			<td class="facebook-email">Wird geladen...</td>
		</tr>
	</table>
	<button onclick="FBdisconnect()">Verbindung beenden</button>
	<?php
} else {
	?>
	<button onclick="FBconnect()">Mit Facebook verbinden</button>
	<?php
}
?>
<h2>Profil bearbeiten</h2>
<?php
if($_GET["action"] == "save"){
	mysql_query("UPDATE `".$db_prefix."User` SET `Vorname` = '".$_POST["vorname"]."' WHERE ID = ".$baru["userID"], $mysql);
	mysql_query("UPDATE `".$db_prefix."User` SET `Nachname` = '".$_POST["nachname"]."' WHERE ID = ".$baru["userID"], $mysql);
	mysql_query("UPDATE `".$db_prefix."User` SET `Email` = '".$_POST["email"]."' WHERE ID = ".$baru["userID"], $mysql);
	if($_POST["pw"]){
		mysql_query("UPDATE `".$db_prefix."User` SET `Passwort` = '".md5($_POST["pw"])."' WHERE ID = ".$baru["userID"], $mysql);
	}
	?>
	<script>window.location.href = "?p=account&saved=success";</script>
	<?php
}

if($_GET["saved"] == "success"){
	hinweis($lang_userSaved);
}

$user = mysql_query("SELECT * FROM ".$db_prefix."User WHERE ID = ".$baru["userID"], $mysql);
if(mysql_error()){
	fehler(mysql_error());
}
$u = mysql_fetch_array($user);
?>
<div id="editUserForm">
	<form method="post" action="?p=account&action=save">
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
			<tr>
				<td><? echo $lang_password; ?>:</td>
				<td><input type="password" name="pw" placeholder="<? echo $lang_password; ?>"></td>
			</tr>
			<tr>
				<td><? echo $lang_group; ?>:</td>
				<td>
				<select disabled>
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
	</form>
</div>