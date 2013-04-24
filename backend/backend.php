<!DOCTYPE html>
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
	#userMenu ul.closed{
		display: none;
	}
	#userMenu ul{
		position: absolute;
		background: white;
		text-align: left;
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
						?>
						<li id="userMenu">
							<a href="javascript:void(0)" onclick="toggleUserMenu()" class="userDropdown"><?php echo $userinfo["Vorname"]; ?></a>
							<ul class="closed">
								<li><a onclick="document.location.href='?action=logout';" class="userMenuLink">[logout]</a></li>
							</ul>
						</li>
						<?php
					}
					?>
					<li><a href="../index.php" target="_BLANK">Frontend</a></li>
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
						if($t != "." && $t != ".." && $t != "readme.txt" && substr($t, -5) == ".baru" && file_exists($verz."/".$t."/init.php")){
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
						<input type="email" id="email" name="email" placeholder="<? echo $lang_username; ?>" size="35"><br>
						<label for="pw"><b>Passwort:</b></label><br>
						<input type="password" id="pw" name="pw" placeholder="<? echo $lang_password; ?>" size="35"><br>
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
	<?php #include $rootPath."/footer.php"; ?>
</body>
</html>