<? include "system/config.php"; ?>
<?
if($_GET["deleteinstaller"] == "ok"){
	unlink("install.php");
}
?>
<html>
<head>
	<title>Baru CMS - <? echo $lang_adminbereichTitle; ?></title>
	<link rel="icon" href="img/favicons/favicon_green.png" type="image/png">
	<link rel="apple-touch-icon" href="img/favicon.png"/>
	<script type="text/javascript" src="/cms/languages/loader.js"></script>
	<script>
	function p(p){
		document.location.href = p;
	}
	
	function logout(){
		logoutWindow = window.open("logout.php", "Logout...", "outerWidth=300,outerHeight=300,scrollbars=no,location=no,menubar=no,toolbar=no");
	}
	
	function createLinkBack(parameter){
		$("#linkBack").html("<small><a href='"+parameter+"'><? echo $lang_back; ?></a></small>");
	}
	</script>
	<style>
	*{
		font-family: Myriad Pro, Calibri, Arial;
	}
	body{
		background-image: url('img/admin_bg.png');
		background-position: fixed;
	}
	
	#top{
		color: white;
		background: black;
		width: 100%;
		height: 40px;
		position: fixed;
		top: 0;
		left: 0;
		box-shadow: 0px 0px 10px #000;
	}
	
	#adminTitle{
		font-size: 20pt;
		font-weight: bold;
	}
	
	#spalt{
		height: 41px;
	}
	
	.adminMenueElement{
		color: white;
		text-decoration: none;
		font-size: 18pt;
	}
	.adminMenueElement:hover{
		background: grey;
	}
	
	.right{
		position: relative;
		right: 10px;
		float: right;
		text-align: right;
	}
	
	.clear{
		clear:left;
		clear:right;
	}
	</style>
	<?
	//activation
	$activation = file_get_contents($activationURL.'check.php?host='.urlencode($_SERVER["SERVER_NAME"])."&code=".$licenseCode[0]);
	if($activation == "valid"){
		//echo $activation;
	} else if($activation == "failed"){
		fehler($lang_licenseNotValid);
		?>
		<script>
		function activate(){
			var l = $("#code").val();
			$("#licenseLoader").load("system/activate.php?new="+l);
		}
		</script>
		<center>
			<div id="licenseLoader"></div>
			<h3><? echo $lang_newLicense; ?>:</h3>
			<input type="text" id="code" placeholder="License"><button onclick="activate()" class="ui-state-default ui-corner-all"><? echo $lang_save; ?></button>
			<br><small><a href="http://bit.ly/Ofzy2z"><? echo $lang_noLicenseYet; ?></a></small>
		</center>
		<?
		exit;
	} else {
		//echo $activation;
	}

	?>
</head>
<body><!--onload="menuOpen('<? echo $_GET["p"]; ?>');"-->
	<style>
	#menu.defaultB {
		width: 99%;
		box-shadow: 0 1px 4px rgba(0,0,0,0.25), inset 0 1px 0 #ceec37;
		border: 1px solid #8ab30b;
		/*border-radius: 5px;*/
		position: relative;
	}

	.defaultB {
		background: -webkit-linear-gradient(#bbe52b 0%, #98c413 100%);
		background: -moz-linear-gradient(#bbe52b 0%, #98c413 100%);
		color: #ffffff;
		padding: 7px;
		font-size: 12pt;
		text-shadow: 0 -1px 0 #85a710;
	}

	.clickB{
		height: 100%;
	}
	.clickB:hover {
		background: -webkit-linear-gradient(#9ec224 0%, #83a812 100%);
		background: -moz-linear-gradient(#9ec224 0%, #83a812 100%);
		box-shadow: 0 1px 4px rgba(0,0,0,0.25);
		cursor: pointer;
	}
	.clickB:active {
		box-shadow: none;
		background: #98c413;
	}
	
	
	#subMenu.defaultSubB {
		width: 80%;
		height: 15px;
		box-shadow: 0 1px 4px rgba(0,0,0,0.25), inset 0 1px 0 #ceec37;
		border: 1px solid #ccc;
		border-top: none !important;
		margin-top: -3px;
		border-radius: 5px;
		/*line-height: 20px;*/
		position: relative;
	}

	.defaultSubB {
		background: -webkit-linear-gradient(#ffffff 0%, #ccc 100%);
		background: -moz-linear-gradient(#ffffff 0%, #ccc 100%);
		color: #000000;
		padding: 7px;
		font-size: 10pt;
		text-shadow: 0 -1px 0 #ccc;
	}
	
	.clickSubB{
		height: 100%;
		border: none;
	}
	.clickSubB:hover {
		background: #ccc;
		box-shadow: 0 1px 4px rgba(0,0,0,0.25);
		cursor: pointer;
	}
	.clickSubB:active {
		box-shadow: none;
		background: #bbb;
	}
	</style>
	<script>
	function menuLink(target){
		document.location.href = target;
	}
	
	function menuOpen(sub){
		//$("#subMenu").fadeOut("fast");
		
		if(sub == "pages"){
			var newSubMenu = '<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=pages\')" style="z-index: 2;"><? echo $lang_adminMenueElementShowPages; ?></span>';
			newSubMenu = newSubMenu+'<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=pages&new=true\')" style="z-index: 2;"><? echo $lang_adminbereichNewPage; ?></span>';
			$("#subMenu").fadeIn("slow");
		}
		
		if(sub == "user" || sub == "usergroups"){
			var newSubMenu = '<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=user\')" style="z-index: 2;"><? echo $lang_adminbereichUserList; ?></span>';
			newSubMenu = newSubMenu+'<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=user&new=true\')" style="z-index: 2;"><? echo $lang_newUser; ?></span>';
			newSubMenu = newSubMenu+'<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=usergroups\')" style="z-index: 2;"><? echo $lang_adminbereichUserGroups; ?></span>';
			newSubMenu = newSubMenu+'<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=account\')" style="z-index: 2;">Dein Account</span>';
			$("#subMenu").fadeIn("slow");
		}
		
		if(sub == "menu"){
			var newSubMenu = '<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=menu\')" style="z-index: 2;"><? echo $lang_mainMenu; ?></span>';
			newSubMenu = newSubMenu+'<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=menu&new=true\')" style="z-index: 2;"><? echo $lang_mainMenuNewLink; ?></span>';
			$("#subMenu").fadeIn("slow");
		}
		
		if(sub == "settings"){
			var newSubMenu = '<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=allgemein\')" style="z-index: 2;"><? echo $lang_adminMenueElementAllgemein; ?></span>';
			newSubMenu = newSubMenu+'<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=templates\')" style="z-index: 2;"><? echo $lang_templates; ?></span>';
			newSubMenu = newSubMenu+'<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=search-settings\')" style="z-index: 2;"><? echo $lang_search; ?></span>';
			$("#subMenu").fadeIn("slow");
		}
		
		if(sub == "more" || sub == "allgemein" || sub == "style" || sub == "update" || sub == "info" || sub == "plugins"){
			var newSubMenu = '<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=style\')" style="z-index: 2;"><? echo $lang_adminMenueElementEditStyle; ?></span>';
			newSubMenu = newSubMenu+'<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=update\')" style="z-index: 2;"><? echo $lang_ECMsearchUpdate; ?></span>';
			newSubMenu = newSubMenu+'<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=info\')" style="z-index: 2;"><? echo $lang_systemInfo; ?></span>';
			newSubMenu = newSubMenu+'<span class="clickSubB defaultSubB" onclick="menuLink(\'admin.php?p=plugins\')" style="z-index: 2;"><? echo $lang_adminMenueElementPlugins; ?></span>';
			$("#subMenu").fadeIn("fast");
		}
		
		$("#subMenu").html(newSubMenu);
	}
	
	
	function menuClose(){
		closeTimeout = setTimeout(menuClose3, 200);
	}
	function menuClose2(){
		closeTimeout = setTimeout(menuClose3, 100);
	}
	function menuClose3(){
		$("#subMenu").fadeOut("fast");
	}
	</script>
	<center style="position: fixed; width: 100%; left: 0px;" onmouseleave="menuClose()">
		<div id="menu" class="defaultB" style="z-index: 100; margin-top: -11px;">
			<span class="clickB defaultB" onmouseover="menuClose2()" onclick="menuLink('admin.php')" style="z-index: 102;"><?php echo $lang_adminbereichTitle; ?></span>
			&nbsp;
			<?php
			if($ECM["login_ok"]){
				?>
				<span class="clickB defaultB" onmouseover="menuOpen('pages')" style="z-index: 102;"><? echo $lang_adminMenueElementPages; ?></span>
				&nbsp;
				<span class="clickB defaultB" onmouseover="menuOpen('user')" style="z-index: 102;"><? echo $lang_adminMenueElementUser; ?></span>
				&nbsp;
				<!--<span class="clickB defaultB" onclick="menuLink('admin.php?p=usergroups')" style="z-index: 102;"><? echo $lang_adminbereichUserGroups; ?></span>
				&nbsp;-->
				<span class="clickB defaultB" onmouseover="menuOpen('menu')" style="z-index: 102;"><? echo $lang_adminMenueElementMenu; ?></span>
				&nbsp;
				<span class="clickB defaultB" onmouseover="menuOpen('settings')" style="z-index: 102;"><? echo $lang_adminMenueElementSettings; ?></span>
				&nbsp;
				<span class="clickB defaultB" onmouseover="menuOpen('more')" style="z-index: 102;"><? echo $lang_adminMenueElementMore; ?></span>
				&nbsp;
				<span class="clickB defaultB" onmouseover="menuClose2()" onclick="logout()" style="z-index: 102;">[<? echo $lang_adminMenueElementLogout; ?>]</span>
				<?
			}
			?>
		</div>
		<div id="subMenu" class="defaultSubB" style="display: none; z-index: 1;">
			
		</div>
	</center>
	<br><br>
	<div id="content">
	<div id="linkBack"></div>
	<?php
	if($ECM["login_ok"] == "1" or $justloggedin){
	
		if($wartung[0] != "1" or $wartung2){
			if(!$_GET["p"]){
				include "admin/main.php";
			}
		
			if($_GET["p"] == "overview"){
				include "admin/main.php";
			} else if($_GET["p"] == "allgemein"){
				include "admin/allgemein.php";
			} else if($_GET["p"] == "user"){
				include "admin/user.php";
			} else if($_GET["p"] == "account"){
				include "admin/yourAccount.php";
			} else if($_GET["p"] == "pages"){
				include "admin/pages.php";
			} else if($_GET["p"] == "menu"){
				include "admin/menu.php";
			} else if($_GET["p"] == "files"){
				include "admin/files.php";
			} else if($_GET["p"] == "style"){
				include "admin/style.php";
			} else if($_GET["p"] == "update"){
				include "admin/updater.php";
			} else if($_GET["p"] == "info"){
				include "admin/info.php";
			} else if($_GET["p"] == "usergroups"){
				include "admin/groups.php";
			} else if($_GET["p"] == "plugins"){
				include "admin/plugins.php";
			} else if($_GET["p"] == "search-settings"){
				include "admin/searchSettings.php";
			} else if($_GET["p"] == "templates"){
				include "admin/templates.php";
			}else if($_GET["p"]){
				fehler($lang_error404);
			}
		} else {
			fehler($lang_wartungsmodusAktiv2);
		}
	} else {
		fehler($lang_notloggedin);
		include "admin/loginForm.php";
	}
	if($wartung2){
		?>
		<style>
		#wartungInfo{
			position: fixed;
			right: 20px;
			bottom: 10px;
			background-color: red;
			height: 40px;
			box-shadow: 0px 0px 20px yellow;
			border-radius: 10px;
		}
		#wartungInfo b{
			position: relative;
			text-decoration: blink;
			top: 10px;
		}
		</style>
		<div id="wartungInfo">
			<b>&nbsp;&nbsp;&nbsp;<? echo $lang_wartungsmodusAktiv2; ?>&nbsp;&nbsp;&nbsp;</b>
		</div>
		<?
	}
	?>
	</div>
	<? include "footer.php"; ?>
	<center>
		<a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.<? echo strtolower($_COOKIE["lang"]); ?>" target="_blank"><img alt="Creative Commons Lizenzvertrag" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/80x15.png" /></a>
	</center>
</body>
</html>