<?php
if(getRights("UPDATE_SETTINGS", $userinfo["Group"])){
?>
<div class="contentHead">
	<h1>Einstellungen</h1>
	<h3>
		<a href="#section-general">Allgemein &raquo;</a>
		<br>
		<a href="#section-design">Design &raquo;</a>
		<br>
		<a href="#section-search">Suche &raquo;</a>
		<br>
		<a href="#section-maintenance">Wartungsmodus &raquo;</a>
	</h3>
</div>
<script>
//Allgemein
function save(){
	var ajaxStatus = $("#ajaxStatus");
	ajaxStatus.html("Speichern...");
	var ed = tinyMCE.get('helloTextTextarea');
	var content = ed.getContent();
	var form_data = {
		language: $("#chooseLang").val(),
		title: $("#pagetitleInput").val(),
		helloText: content,
		is_ajax: 1
	};
	
	jQuery.ajax({
		type: "POST",
		url: "backendModules/settings.baru/save.php",
		data: form_data,
		success: function(response)
		{
			if(response == "success"){
				ajaxStatus.html("Gespeichert!");
				setTimeout(statusReset, 2500);
			} else {
				if(response == 1){
					var errorMsg = "Sprache wurde nicht gespeichert!";
				} else if(response == 2){
					var errorMsg = "Willkommensmeldung wurde nicht gespeichert!";
				} else if(response == 3){
					var errorMsg = "Seitentitel wurde nicht gespeichert!";
				} else {
					var errorMsg = "Ein unbekannter Fehler ist aufgetreten!";
				}
				ajaxStatus.html(errorMsg);
			}
		}
	});
	return false;
}

function statusReset2(){
	var ajaxStatus = $("#ajaxStatus2");
	ajaxStatus.html("");
}

//Wartungsmodus
function save2(){
	var ajaxStatus = $("#ajaxStatus2");
	ajaxStatus.html("Speichern...");
	var form_data = {
		wartungsmodus: 1,
		is_ajax: 1
	};
	
	jQuery.ajax({
		type: "POST",
		url: "backendModules/settings.baru/save.php",
		data: form_data,
		success: function(response)
		{
			if(response == "success1" || response == "success0"){
				if(response == "success1"){
					$("#wartungsmodus").html("deaktivieren");
				}
				if(response == "success0"){
					$("#wartungsmodus").html("aktivieren");
				}
				ajaxStatus.html("Gespeichert!");
				setTimeout(statusReset2, 2500);
			} else {
				if(response == 4){
					var errorMsg = "Wartungsmodus wurde nicht geändert!";
				} else {
					var errorMsg = "Ein unbekannter Fehler ist aufgetreten!";
				}
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
<h2 id="section-general">Allgemein <small class="link-top"><a href="#top">&#8593; top &#8593;</a></small></h2>
<table border="0">
	<tbody valign="top">
		<!-- disabled at the moment
		<tr>
			<td class="tdFirst">Systemsprache:</td>
			<td>
				<select id="chooseLang" name="language">
					<?php
					$verzeichnis = $rootPath."/languages/";
					$langs = scandir($verzeichnis);
					foreach($langs as $l) {
					if($l != "." && $l != ".." && substr($l, -4) == ".php"){
						if(getSetting("LANGUAGE") == substr($l, 0, -4)){
							?>
							<option value="<?php echo substr($l, 0, -4); ?>" selected><?php echo substr($l, 0, -4); ?></option>
							<?php
						} else {
							?>
							<option value="<?php echo substr($l, 0, -4); ?>"><?php echo substr($l, 0, -4); ?></option>
							<?php
						}
					}
					};
					?>
				</select>
			</td>
		</tr>-->
		<tr>
			<td class="tdFirst">Seitentitel:</td>
			<td><input type="text" id="pagetitleInput" name="titel" size="70" value="<? echo getSetting("PAGE_TITLE"); ?>" placeholder="<? echo $lang_adminbereichAllgemeinInputTitle; ?>"></td>
		</tr>
		<tr>
			<td class="tdFirst">Willkommensmeldung:</td>
			<td>
				<textarea id="helloTextTextarea" name="helloText" class="advancedEditor" rows="20" cols="90"><? echo getSetting("HELLO_TEXT"); ?></textarea>			
			</td>
		</tr>
		<tr>
			<td class="tdFirst"></td>
			<td><button onclick="save()" class="ui-state-default ui-corner-all">Speichern</button><span id="ajaxStatus"></span></td>
		</tr>
	</tbody>
</table>
<h2 id="section-design">Design <small class="link-top"><a href="#top">&#8593; top &#8593;</a></small></h2>
<script>
function saveTemplate(){
	var ajaxStatus = $("#ajaxStatus3");
	ajaxStatus.html("Speichern...");
	var form_data = {
		template: $("#templateChooser").val(),
		is_ajax: 1
	};
	
	jQuery.ajax({
		type: "POST",
		url: "backendModules/settings.baru/save.php",
		data: form_data,
		success: function(response)
		{
			if(response == "success"){
				ajaxStatus.html("Gespeichert!");
				setTimeout(statusReset3, 2500);
			} else {
				var errorMsg = "Ein unbekannter Fehler ist aufgetreten!";
				ajaxStatus.html(errorMsg);
			}
		}
	});
	return false;
}

function statusReset3(){
	var ajaxStatus = $("#ajaxStatus3");
	ajaxStatus.html("");
}
</script>
<table>
	<tbody valign="top">
		<tr>
			<td class="tdFirst">Hintergrund:</td>
			<td>
				<button onclick="uploadBg()" class="ui-state-default ui-corner-all" disabled>&auml;ndern</button>
			</td>
		</tr>
		<tr>
			<td class="tdFirst">Template:</td>
			<td>
				<select id="templateChooser">
				<?php
				$verz = $rootPath."/templates/";
				$dateien = scandir($verz);
				foreach($dateien as $t) {
					if($t != "." && $t != ".." && $t != "readme.txt"){
						$info = file($rootPath."/templates/".$t."/info.txt");
						$anzahl++;
						if(getSetting("TEMPLATE") == $t){
							echo '<option value="'.$t.'" selected>'.$info[0].'</option>';
						} else {
							echo '<option value="'.$t.'">'.$info[0].'</option>';
						}
					}
				};
				?>
				</select>
				<button onclick="saveTemplate()" class="ui-state-default ui-corner-all">Speichern</button><span id="ajaxStatus3"></span>
			</td>
		</tr>
	</tbody>
</table>
<h2 id="section-search">Suche <small class="link-top"><a href="#top">&#8593; top &#8593;</a></small></h2>
<script>
function save4(){
	var ajaxStatus = $("#ajaxStatus4");
	ajaxStatus.html("Speichern...");
	var form_data = {
		searchToggle: 1,
		is_ajax: 1
	};
	
	jQuery.ajax({
		type: "POST",
		url: "backendModules/settings.baru/save.php",
		data: form_data,
		success: function(response)
		{
			if(response == "success1" || response == "success0"){
				if(response == "success1"){
					$("#searchToggle").html("deaktivieren");
				}
				if(response == "success0"){
					$("#searchToggle").html("aktivieren");
				}
				ajaxStatus.html("Gespeichert!");
				setTimeout(statusReset4, 2500);
			} else {
				if(response == 4){
					var errorMsg = "Einstellungen wurden nicht geändert!";
				} else {
					var errorMsg = "Ein unbekannter Fehler ist aufgetreten!";
				}
				ajaxStatus.html(errorMsg);
			}
		}
	});
	return false;
}

function statusReset4(){
	var ajaxStatus = $("#ajaxStatus4");
	ajaxStatus.html("");
}
</script>
<table>
	<tbody valign="top">
		<tr>
			<td class="tdFirst">Suchfunktion aktivieren:</td>
			<td>
				<?
				if(getSetting("SEARCH_ACTIVE") == "1"){
					?>
					<button id="searchToggle" onclick="save4()" class="ui-state-default ui-corner-all">deaktivieren</button><span id="ajaxStatus4"></span>
					<?
				} else {
					?>
					<button id="searchToggle" onclick="save4()" class="ui-state-default ui-corner-all">aktivieren</button><span id="ajaxStatus4"></span>
					<?
				}
				?>
			</td>
		</tr>
		<tr>
			<td class="tdFirst">Mindestl&auml;nge des Suchbegriffs:</td>
			<td>
				<input type="number" id="searchMinLength" size="2" value="<?php echo getSetting("SEARCH_MIN_LENGTH"); ?>" disabled>
			</td>
		</tr>
		<tr>
			<td class="tdFirst"></td>
			<td>
				<button onclick="save5()" class="ui-state-default ui-corner-all" disabled>Speichern</button><span id="ajaxStatus5"></span>
			</td>
		</tr>
	</tbody>
</table>
<h2 id="section-maintenance">Wartungsmodus <small class="link-top"><a href="#top">&#8593; top &#8593;</a></small></h2>
<table>
	<tbody valign="top">
		<tr>
			<td class="tdFirst">Wartungsmodus:</td>
			<td>
				<?
				if(getSetting("WARTUNG") == "1"){
					?>
					<button id="wartungsmodus" onclick="save2()" class="ui-state-default ui-corner-all">deaktivieren</button><span id="ajaxStatus2"></span>
					<?
				} else {
					?>
					<button id="wartungsmodus" onclick="save2()" class="ui-state-default ui-corner-all">aktivieren</button><span id="ajaxStatus2"></span>
					<?
				}
				?>
			</td>
		</tr>
	</tbody>
</table>
<?php
//permission-check END
} else {
	echo errorcode(403, true);
}
?>