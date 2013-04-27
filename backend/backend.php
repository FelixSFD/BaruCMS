<?php
#echo $_SERVER["DOCUMENT_ROOT"].dirname($_SERVER["SCRIPT_NAME"]);
#include $_SERVER["DOCUMENT_ROOT"].dirname($_SERVER["SCRIPT_NAME"])."/../adminAPI.php";
if($_GET["action"] == "logout"){
	setcookie("login_id", "", time()-time()*99, "/");
	header("Location: backend.php");
	exit;
}

$documentRoot = $_SERVER["DOCUMENT_ROOT"];
if(file_exists($documentRoot.dirname($_SERVER["SCRIPT_NAME"])."/db_config.php")){
	$rootPath = $documentRoot.dirname($_SERVER["SCRIPT_NAME"]);
} else {
	$rootPath = getcwd()."/..";
}
include $rootPath."/adminAPI.php";
?>
<html lang="de">
<head>
	<title>BaruCMS Administration</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<link rel="stylesheet" type="text/css" href="./src/css/backend.css">
	<?php
		if(ModuleExists($module) == true) {
			echo '<link rel="stylesheet" type="text/css" href="./backendModules/'.$module.'.baru/main.css">';
		} else {
			echo '<style>#menu {border-bottom: 5px solid #000000;}</style>';
		}
	?>
	<link rel="shortcut icon" href="./src/img/favicon.ico" />
	<meta name="viewport" content="width=1000, maximum-scale=1.0">
	<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans:300,400' rel='stylesheet' type='text/css'>
	<link href='http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css' rel='stylesheet' type='text/css'>
	<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
	<script src="http://code.jquery.com/jquery-2.0.0.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script type="text/javascript" src="../system/jQuery/plugins/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
	<script src="./src/js/dropdown.js"></script>
	<script type="text/javascript">
		$().ready(function() {
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
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,,ltr,rtl,|,fullscreen",
				theme_advanced_buttons4 : "jbimages,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,


				// Replace values for the template plugin
				template_replace_values : {
					username : "Some User",
					staffid : "991234"
				}
			});
			/*$( document ).tooltip({
				position: {
					my: "center bottom-20",
					at: "center top",
					using: function( position, feedback ) {
						$( this ).css( position );
						$( "<div>" )
						.addClass( "arrow" )
						.addClass( feedback.vertical )
						.addClass( feedback.horizontal )
						.appendTo( this );
					}
				}
			});*/
		});
		
		var menuOpen = false;
		function toggleUserMenu(){
			if(menuOpen){
				$("#userMenu").children("ul").slideUp();
				menuOpen = false;
			} else {
				$("#userMenu").children("ul").slideDown();
				menuOpen = true;
			}
		}
	</script>
	<style>
	/* jQueryUI Tooltip
	.ui-tooltip, .arrow:after {
		background: black;
		border: 2px solid white;
	}
	.ui-tooltip {
		padding: 10px 20px;
		color: white;
		border-radius: 20px;
		font: bold 14px "Helvetica Neue", Sans-Serif;
		text-transform: uppercase;
		box-shadow: 0 0 7px black;
	}
	.arrow {
		width: 70px;
		height: 16px;
		overflow: hidden;
		position: absolute;
		left: 50%;
		margin-left: -35px;
		bottom: -16px;
	}
	.arrow.top {
		top: -16px;
		bottom: auto;
	}
	.arrow.left {
		left: 20%;
	}
	.arrow:after {
		content: "";
		position: absolute;
		left: 20px;
		top: -20px;
		width: 25px;
		height: 25px;
		box-shadow: 6px 5px 9px -9px black;
		-webkit-transform: rotate(45deg);
		-moz-transform: rotate(45deg);
		-ms-transform: rotate(45deg);
		-o-transform: rotate(45deg);
		tranform: rotate(45deg);
	}
	.arrow.top:after {
		bottom: -20px;
		top: auto;
	}
	end */
	
	.userDropdown:before {
		content: '';
		background-image: url('../img/userDropdown.png');
		background-position: 0px 0px;
		width: 12px;
		height: 11px;
		float: left;
		margin-top: 3px;
		margin-right: 10px;
	}

	.userDropdown:hover:before {
		background-position: 0px 11px;
	}

	.userDropdown:after {
		content: '';
		width: 0;
		height: 0;
		border-left: 5px solid transparent;
		border-right: 5px solid transparent;
		border-top: 5px solid #cccccc;
		position: absolute;
		margin-left: 7px;
		margin-top: 6px;
	}

	.userDropdown:hover:after {
		border-top: 5px solid #ffffff;
	}

	ul.dropdownMenu:before {
		content: '';
		position: absolute;
		width: 0px;
		height: 0px;
		border-style: solid;
		border-width: 0 10px 10px 10px;
		border-color: transparent transparent #ffffff transparent;
		margin-top: -10px;
		margin-left: 20px;
	}

	ul.dropdownMenu {
		position: absolute;
		background: #ffffff;
		z-index: 1;
		margin-top: 10px!important;
		border-radius: 2px;
		border: 1px solid #cccccc;
		display: none;
		width: 200px;
		padding-bottom: 5px!important;
	}

	ul.dropdownMenu li, ul.dropdownMenu li a {
		float: none!important;
		text-transform: none!important;
		color: #333333!important;
		padding: 5px 20px 5px 45px!important;
		margin: 0px!important;
		font-weight: normal;
	}

	ul.dropdownMenu li:hover {
		background: #f1f1f1;
		cursor: pointer;
	}

	.userPic {
		-webkit-border-radius: 50em;
		-moz-border-radius: 50em;
		border-radius: 50em;
		width: 40px;
		height: 40px;
		background-size: cover;
		background-position: center top;
		float: left;
		margin-right: 15px;
	}

	.userOverview {
		height: 50px;
		padding: 20px 30px 5px 20px!important;
		color: #999999;
	}

	.userOverview span.role {
		text-transform: none;
		font-size: 10px;
	}

	ul.dropdownMenu li img {
		position: absolute;
		margin-top: 1px;
		margin-left: -25px;
	}
	</style>
</head>
<body>
	<div id="header">
		<div class="container">
			<div class="pageTitle">BaruCMS Administration</div>
				<div id="headerMenu">
					<ul>
					<?php
					if($baru["login_ok"]){
						$usergroupQuery = $db->query("SELECT * FROM ".$db_prefix."Groups WHERE ID = '".$userinfo["Group"]."'");
						$usergroupResult = $usergroupQuery->fetch_object();
						?>
						<li>
							<a class="userDropdown" href="#"><?php echo $userinfo["Vorname"]; ?></a>
							<ul class="dropdownMenu">
								<div class="userOverview">
									<div class="userPic" style="background-image: url('./src/img/dummyUser.png');"></div>
									<?php echo $userinfo["Vorname"]." ".$userinfo["Nachname"]; ?><br />
									<span class="role"><?php echo $usergroupResult->Name; ?></span>
								</div>
								<?php
								$verz = $rootPath."/backend/backendModules/";
								$dateien = scandir($verz);
								foreach($dateien as $t) {
									$moduleConfigPath = $rootPath."/backend/backendModules/".$t."/config.xml";
									if(file_Exists($moduleConfigPath)){
										$moduleConfigXML = simplexml_load_file($moduleConfigPath);
									}
									if(substr($t, -5) == ".baru" && file_exists($verz."/".$t."/init.php") && $moduleConfigXML->config->display == "dropdown"){
										$info = file($rootPath."/backend/backendModules/".$t."/info_".getSetting("LANGUAGE").".txt");
										?>
										<li onclick="location.href='?module=<?php echo substr($t, 0, -5); ?>'"><img height="16px" alt=" " src="./src/img/icons/<?php echo $moduleConfigXML->config->icon; ?>" /><?php echo $moduleConfigXML->info->name; ?></li>
										<?php
									}
								};
								?>
								<li onclick="window.open('https://github.com/FelixSFD/BaruCMS')"><img src="./src/img/icons/compass_16x16.png" />Hilfe</li>
								<li onclick="location.href='?action=logout'"><img src="./src/img/icons/arrow_left_alt1_16x16.png" />Logout</li>
							</ul>
						</li>
						<?php
						}
						?>
						<li><a href="../index.php">Frontend</a></li>
					</ul>
				</div>
		</div>
	</div>
	<?php
	if($baru["login_ok"]){
	?>
	<div id="menu">
		<div class="container">
			<div class="menuContainer">
				<ul>
					<?php
					$menuColors = array("Red", "Lightblue", "Lightgreen", "Purple", "Darkblue", "Orange", "Darkgreen");
					$menuColorCodes = array("e45129", "1587c8", "7ea023", "8637ab", "3745ab", "e69e2c", "347f07");
					$verz = $rootPath."/backend/backendModules/";
					$dateien = scandir($verz);
					$anzahl = 0;
					foreach($dateien as $t) {
						$moduleConfigPath = $rootPath."/backend/backendModules/".$t."/config.xml";
						if(file_Exists($moduleConfigPath)){
							$moduleConfigXML = simplexml_load_file($moduleConfigPath);
						}
						if($t != "." && $t != ".." && $t != "readme.txt" && substr($t, -5) == ".baru" && file_exists($verz."/".$t."/init.php") && $moduleConfigXML->config->display == "default"){
							$info = file($rootPath."/backend/backendModules/".$t."/info_".getSetting("LANGUAGE").".txt");
							echo '<div class="menuDivider"></div>';
							?>
							<li class="menuColor<?php echo $menuColors[$anzahl]." ".ActiveMenu($t); ?>" onclick="location.href='backend.php?module=<?php echo substr($t, 0, -5); ?>'"><?php echo $info[0]; ?></li>
							<?php
							if(ActiveMenu($t)){
								?>
								<style>
								#menu {
									border-bottom: 5px solid #<?php echo $menuColorCodes[$anzahl]; ?>!important;
								}

								h1, h2 {
									color: #<?php echo $menuColorCodes[$anzahl]; ?>!important;
								}
								</style>
								<?php
							}
							if($anzahl >= 6){
								$anzahl = 0;
							} else {
								$anzahl++;
							}
						}
					};
					echo '<div class="menuDivider"></div>';
					?>
				</ul>
			</div>			
		</div>
	</div>
	<?php
	}
	?>
	<div id="content">
		<div class="container">
			<?php
			if($baru["login_ok"]){
				if(ModuleExists($module) == true) {
					require($rootPath.'/backend/backendModules/'.$module.'.baru/init.php');
				} else {
					echo errorcode(404);
				}
			} else {
				if($loginerror){
					fehler($loginerror);
				} else {
					errorcode(403);
				}
				?>
				<br><br>
				<center>
					<form method="post" id="loginForm" action="backend.php">
						<label for="email"><b>E-Mail:</b></label><br>
						<input type="email" id="email" name="email" placeholder="E-Mail" size="35"><br>
						<label for="pw"><b>Passwort:</b></label><br>
						<input type="password" id="pw" name="pw" placeholder="Passwort" size="35"><br>
						<br>
						<input type="hidden" name="action" value="login">
						<button type="submit">LOGIN</button>
					</form>
				</center>
				<?php
			}
			?>
		</div>
	</div>
	<div id="footer">
		<center>
		<?php
		$currentModuleConfigPath = $rootPath."/backend/backendModules/".$module.".baru/config.xml";
		$currentModuleConfigXML = simplexml_load_file($currentModuleConfigPath);
		if($currentModuleConfigXML->config->show_footer){
			echo "Modul <i>".$currentModuleConfigXML->info->name ."</i> (Version: ".$currentModuleConfigXML->info->version .") &copy; <i>".$currentModuleConfigXML->info->author ."</i>";
		}
		?>
		 - 
		BaruCMS 1.0 BETA - &copy; Felix Deil 2012-2013
		</center>
	</div>
</body>
</html>