<?php
if(getRights("UPDATE_SETTINGS", $userinfo["Group"])){
?>
<div class="contentHead">
	<h1><?php echo $currentModuleConfigXML->info->name->$language; ?></h1>
	<h3>
		<a href="#section-general"><?php echo $l->general; ?> &raquo;</a>
		<br>
		<a href="#section-design"><?php echo $l->design; ?> &raquo;</a>
		<br>
		<a href="#section-search"><?php echo $l->search; ?> &raquo;</a>
		<br>
		<a href="#section-maintenance"><?php echo $l->maintenanceMode; ?> &raquo;</a>
	</h3>
</div>
<script>
//Allgemein
function save(){
	var ajaxStatus = $("#ajaxStatus");
	ajaxStatus.html("<?php echo $l->saving; ?>...");
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
	ajaxStatus.html("<?php echo $l->saving; ?>...");
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
<h2 id="section-general"><?php echo $l->general; ?> <small class="link-top"><a href="#top">&#8593; <?php echo $l->toTop; ?> &#8593;</a></small></h2>
<table border="0">
	<tbody valign="top">
		<tr>
			<td class="tdFirst"><?php echo $l->systemLanguage; ?>:</td>
			<td>
				<select id="chooseLang" name="language">
					<?php
					$languages = simplexml_load_file($rootPath."/languages/languages.xml");
					foreach($languages->language as $lang){
						if($lang->code == $language){
							echo '<option value="'.$lang->code .'" selected>'.$lang->name .'</option>';
						} else {
							echo '<option value="'.$lang->code .'">'.$lang->name .'</option>';
						}
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="tdFirst"><?php echo $l->pageTitle; ?>:</td>
			<td><input type="text" id="pagetitleInput" name="titel" size="70" value="<? echo getSetting("PAGE_TITLE"); ?>" placeholder="<? echo $lang_adminbereichAllgemeinInputTitle; ?>"></td>
		</tr>
		<tr>
			<td class="tdFirst"><?php echo $l->welcome; ?>:</td>
			<td>
				<textarea id="helloTextTextarea" name="helloText" class="advancedEditor" rows="20" cols="90"><? echo getSetting("HELLO_TEXT"); ?></textarea>			
			</td>
		</tr>
		<tr>
			<td class="tdFirst"></td>
			<td><button onclick="save()" class="ui-state-default ui-corner-all"><?php echo $l->save; ?></button><span id="ajaxStatus"></span></td>
		</tr>
	</tbody>
</table>
<h2 id="section-design"><?php echo $l->design; ?> <small class="link-top"><a href="#top">&#8593; <?php echo $l->toTop; ?> &#8593;</a></small></h2>
<script>
function saveTemplate(){
	var ajaxStatus = $("#ajaxStatus3");
	ajaxStatus.html("<?php echo $l->saving; ?>...");
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
		<!--<tr>
			<td class="tdFirst">Hintergrund:</td>
			<td>
				<button onclick="uploadBg()" class="ui-state-default ui-corner-all" disabled>&auml;ndern</button>
			</td>
		</tr>-->
		<tr>
			<td class="tdFirst"><?php echo $l->template; ?>:</td>
			<td>
				<select id="templateChooser">
				<?php
				$verz = $rootPath."/templates/";
				$dateien = scandir($verz);
				foreach($dateien as $t) {
					if($t != "." && $t != ".." && $t != "readme.txt"){
						$info = simplexml_load_file($rootPath."/templates/".$t."/config.xml");
						$anzahl++;
						if(getSetting("TEMPLATE") == $t){
							echo '<option value="'.$t.'" selected>'.$info->name.'</option>';
						} else {
							echo '<option value="'.$t.'">'.$info->name.'</option>';
						}
					}
				};
				?>
				</select>
				<button onclick="saveTemplate()" class="ui-state-default ui-corner-all"><?php echo $l->save; ?></button><span id="ajaxStatus3"></span>
			</td>
		</tr>
	</tbody>
</table>
<h2 id="section-search"><?php echo $l->search; ?> <small class="link-top"><a href="#top">&#8593; <?php echo $l->toTop; ?> &#8593;</a></small></h2>
<script>
function save4(){
	var ajaxStatus = $("#ajaxStatus4");
	ajaxStatus.html("<?php echo $l->saving; ?>...");
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

function save5(){
	var ajaxStatus = $("#ajaxStatus5");
	ajaxStatus.html("<?php echo $l->saving; ?>...");
	var form_data = {
		searchMinLength: $("#searchMinLength").val(),
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
				setTimeout(statusReset5, 2500);
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

function statusReset5(){
	var ajaxStatus = $("#ajaxStatus5");
	ajaxStatus.html("");
}
</script>
<table>
	<tbody valign="top">
		<tr>
			<td class="tdFirst"><?php echo $l->activateSearch; ?>:</td>
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
		<!--<tr>
			<td class="tdFirst">Mindestl&auml;nge des Suchbegriffs:</td>
			<td>
				<input type="number" id="searchMinLength" size="2" value="<?php echo getSetting("SEARCH_MIN_LENGTH"); ?>">
			</td>
		</tr>
		<tr>
			<td class="tdFirst"></td>
			<td>
				<button onclick="save5()" class="ui-state-default ui-corner-all"><?php echo $l->save; ?></button><span id="ajaxStatus5"></span>
			</td>
		</tr>-->
	</tbody>
</table>
<h2 id="section-maintenance"><?php echo $l->maintenanceMode; ?> <small class="link-top"><a href="#top">&#8593; <?php echo $l->toTop; ?> &#8593;</a></small></h2>
<table>
	<tbody valign="top">
		<tr>
			<td class="tdFirst"><?php echo $l->maintenanceMode; ?>:</td>
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