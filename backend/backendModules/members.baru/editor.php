<?php
include "../../../adminAPI.php";
$user = mysql_query("SELECT * FROM ".$db_prefix."User WHERE ID = '".$_GET["userID"]."'", $mysql);
if(mysql_error()){
	fehler(mysql_error());
}
$u = mysql_fetch_array($user);
?>
<table>
	<tr>
		<td>Vorname:</td>
		<td><input type="text" id="vorname" value="<?php echo $u["Vorname"]; ?>" placeholder="Vorname"></td>
	</tr>
	<tr>
		<td>Nachname:</td>
		<td><input type="text" id="nachname" value="<?php echo $u["Nachname"]; ?>" placeholder="Nachname"></td>
	</tr>
	<tr>
		<td>E-Mail:</td>
		<td><input type="email" id="email" value="<?php echo $u["Email"]; ?>" placeholder="E-Mail"></td>
	</tr>
	<tr>
		<td>Passwort:</td>
		<td><input id="pw" onfocus="hinweisWeg()" type="password" id="pw" placeholder="Passwort"></td>
		<td><a id="pwGenerator" onclick="generatePW()" href="javascript:void(0)">zuf&auml;lliges Passwort</a></td>
	</tr>
	<tr>
		<td>Gruppe:</td>
		<td>
		<select id="group">
			<?php
			$groups = mysql_query("SELECT * FROM ".$db_prefix."Groups", $mysql);
			echo mysql_error();
			while ($g = mysql_fetch_array($groups)) {
				if($g["ID"] == $u["Group"]){
					?>
					<option value="<?php echo $g["ID"]; ?>" selected><?php echo $g["Name"]; ?></option>
					<?php
				} else {
					?>
					<option value="<?php echo $g["ID"]; ?>"><?php echo $g["Name"]; ?></option>
					<?php
				}
			}
			?>
		</select>
		</td>
	</tr>
	<tr>
		<td></td>
		<td><button onclick="save()">Speichern</button><span id="ajaxStatus"></span></td>
	</tr>
</table>
<input type="hidden" id="id" value="<?php echo $u["ID"]; ?>" />
<div id="autoPwHinweis" style="display: none;"></div>