<?php
error_reporting(E_ALL|E_STRICT);
#error_reporting(0);
?>
<html>
<head>
	<title>Baru CMS 1.0 BETA - Installer</title>
	<style type="text/css">
	#mmmain{
		height: 600px; /* H�he der div-Box */
		width: 700px; /* Breite der div-Box */
		margin-top: -300px; /* Damit der "Ausrichtungspunkt" in der Mitte der Box liegt */
		margin-left: -350px;
		position: absolute; /* positionieren */
		top: 50%; /* in die Mitte verschieben */
		left: 50%;
		
		/* weitere Angaben */
		background-color: #DDD;
		border: none;
		box-shadow: 0 0 5px 5px #888;
		border-radius: 6px;
		font-family: Myriad Pro, Calibri;
	}
	
	#top{
		margin-top: -82px;
	}
	#top p{
		font-size: 16pt;
	}
	
	#content{
		height: 500px;
	}
	
	#bottom button{
		margin-top: 90px;
	}
	
	button{
		background: -webkit-linear-gradient(#bbe52b 0%, #98c413 100%);
		background: -moz-linear-gradient(#bbe52b 0%, #98c413 100%);
		border: 1px solid #8ab30b;
		border-radius: 5px;
		color: #ffffff;
		padding: 7px;
		font-size: 9pt;
		text-shadow: 0 -1px 0 #85a710;
		box-shadow: 0 1px 4px rgba(0,0,0,0.25), inset 0 1px 0 #ceec37;
	}

	button:hover{
		background: -webkit-linear-gradient(#9ec224 0%, #83a812 100%);
		background: -moz-linear-gradient(#9ec224 0%, #83a812 100%);
		box-shadow: 0 1px 4px rgba(0,0,0,0.25);
		cursor: pointer;
	}

	button:active{
		box-shadow: none;
	}
	
	
	/*Schatten*/
	#main{
	
		height: 600px; /* H�he der div-Box */
		width: 700px; /* Breite der div-Box */
		margin-top: -350px; /* Damit der "Ausrichtungspunkt" in der Mitte der Box liegt */
		margin-left: -350px;
		position: absolute; /* positionieren */
		top: 50%; /* in die Mitte verschieben */
		left: 50%;
		
		
		/*position: relative;
		width: 60%;*/
		background: #ddd;
		border-radius: 4px;
		padding: 2em 1.5em;
		color: rgba(0,0,0, .8);
		text-shadow: 0 1px 0 #fff;
		line-height: 1.5;
		/*margin: 60px auto;*/
	}

	#main:before, #main:after {
		z-index: -1; 
		position: absolute; 
		content: "";
		bottom: 15px;
		left: 10px;
		width: 50%; 
		top: 80%;
		max-width:300px;
		background: rgba(0, 0, 0, 0.7); 
		-webkit-box-shadow: 0 15px 10px rgba(0,0,0, 0.7);   
		-moz-box-shadow: 0 15px 10px rgba(0, 0, 0, 0.7);
		box-shadow: 0 15px 10px rgba(0, 0, 0, 0.7);
		-webkit-transform: rotate(-3deg);    
		-moz-transform: rotate(-3deg);   
		-o-transform: rotate(-3deg);
		transform: rotate(-3deg);
	}

	#main:after {
		-webkit-transform: rotate(3deg);
		-moz-transform: rotate(3deg);
		-o-transform: rotate(3deg);
		transform: rotate(3deg);
		right: 10px;
		left: auto;
	}
	
	
	#footer{
		position: absolute;
		bottom: 4px;
		right: 15px;
	}
	
	#logo{
		width: 83px;
		height: 83px;
		margin-top: -77px;
		background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFMAAABTCAYAAADjsjsAAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFRUM5QzJFRjJDRTExMUUyOTc2MEI4QTZBMUJCRDU3MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFRUM5QzJGMDJDRTExMUUyOTc2MEI4QTZBMUJCRDU3MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkVFQzlDMkVEMkNFMTExRTI5NzYwQjhBNkExQkJENTcxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkVFQzlDMkVFMkNFMTExRTI5NzYwQjhBNkExQkJENTcxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8++vfKZQAAJdRJREFUeNrsfQmw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%3D%3D');
	}
	</style>
	<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
	<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
	<link type="text/css" href="http://code.jquery.com/ui/1.9.0/themes/sunny/jquery-ui.css" rel="Stylesheet">
	</style>
	<script>
	function weiter(){
		document.location.href = "complete.php";
	}
	function zurueck(){
		document.location.href = "../setup.php";
	}
	</script>
</head>
<body>
	<div id="main">
		<div id="top">
			<p align=right>Installationsfortschritt <span id="prozent">50%</span></p>
			<span id="s1DL"></span>
		</div>
		<div id="content">
			<div id="logo">
			</div>
			<div id="start">
				<center><h1>Creating tables</h1></center>
				<?php
				include_once "../db_config.php";
				$documentRoot = $_SERVER["DOCUMENT_ROOT"];
				global $rootPath;
				if(file_exists($documentRoot.dirname($_SERVER["SCRIPT_NAME"])."/db_config.php")){
					$rootPath = $documentRoot.dirname($_SERVER["SCRIPT_NAME"]);
				} else if(file_exists(getcwd()."/../db_config.php")){
					$rootPath = getcwd()."/..";
				} else if(file_exists(getcwd()."/../../db_config.php")){
					$rootPath = getcwd()."/../..";
				} else if(file_exists(getcwd()."/../../../db_config.php")){
					$rootPath = getcwd()."/../../..";
				} else if(file_exists(getcwd()."/../../../../db_config.php")){
					$rootPath = getcwd()."/../../../..";
				}
				include "../system/classes/baruPassword.class.php";
				
				$mysql = mysql_connect($db_host, $db_user, $db_pass);
				mysql_select_db($db_name, $mysql);
				echo mysql_error();
				//Categoriey
				mysql_query("CREATE TABLE ".$db_prefix."Categories (
				ID INT AUTO_INCREMENT PRIMARY KEY,
				Name TEXT NOT NULL,
				url TEXT NOT NULL,
				visibility TEXT NOT NULL);", $mysql);

				//User
				mysql_query("CREATE TABLE ".$db_prefix."User (
				ID INT AUTO_INCREMENT PRIMARY KEY,
				Vorname TEXT NOT NULL,
				Nachname TEXT NOT NULL,
				Email TEXT NOT NULL,
				Passwort TEXT NOT NULL,
				`Group` INT NOT NULL,
				`RegistrationDate` TEXT NOT NULL,
				Status INT NOT NULL);", $mysql);

				//Seiten
				mysql_query("CREATE TABLE ".$db_prefix."Pages (
				ID INT AUTO_INCREMENT PRIMARY KEY,
				Titel TEXT NOT NULL,
				Inhalt TEXT NOT NULL,
				Autor INT NOT NULL,
				url TEXT NOT NULL,
				im_Blog INT NOT NULL,
				Category INT NOT NULL,
				Datum TEXT NOT NULL);", $mysql);

				//Rights
				mysql_query("CREATE TABLE ".$db_prefix."Rights (
				ID INT AUTO_INCREMENT PRIMARY KEY,
				Name TEXT NOT NULL,
				GroupID INT NOT NULL);", $mysql);

				//Groups
				mysql_query("CREATE TABLE ".$db_prefix."Groups (
				ID INT AUTO_INCREMENT PRIMARY KEY,
				Name TEXT NOT NULL);", $mysql);

				//Session
				mysql_query("CREATE TABLE ".$db_prefix."Session (
				User INT NOT NULL,
				Session TEXT NOT NULL,
				IP TEXT NOT NULL,
				Expires INT NOT NULL);", $mysql);

				//Settings
				mysql_query("CREATE TABLE ".$db_prefix."Settings (
				ID INT NOT NULL,
				Name TEXT NOT NULL,
				Value TEXT NOT NULL);", $mysql);
				$now = time();
				mysql_query("INSERT INTO `".$db_prefix."User` VALUES ('1', 'Super', 'User', 'super@user.com', 'password', '1', '".$now."', '1')", $mysql); //password is: barucms
				mysql_query("INSERT INTO `".$db_prefix."Groups` VALUES ('1', 'Administratoren')", $mysql);
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'EDIT_USER', '1')", $mysql);
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'EDIT_USERGROUPS', '1')", $mysql);
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'UPDATE_SETTINGS', '1')", $mysql);
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'UPDATE_SYSTEM', '1')", $mysql);
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'VIEW_SYSTEM_INFO', '1')", $mysql);
				mysql_query("INSERT INTO `".$db_prefix."Rights` VALUES ('', 'EDIT_PAGES', '1')", $mysql);

				mysql_query("INSERT INTO `".$db_prefix."Settings` VALUES ('', 'HELLO_TEXT', '<h2>Danke, dass du Baru CMS installiert hast</h2><a href=\"backend/backend.php\">Zum Backend</a>')", $mysql);
				mysql_query("INSERT INTO `".$db_prefix."Settings` VALUES ('', 'LANGUAGE', 'DE')", $mysql);
				mysql_query("INSERT INTO `".$db_prefix."Settings` VALUES ('', 'PAGE_TITLE', 'Baru CMS')", $mysql);
				mysql_query("INSERT INTO `".$db_prefix."Settings` VALUES ('', 'WARTUNG', '')", $mysql);
				mysql_query("INSERT INTO `".$db_prefix."Settings` VALUES ('', 'SEARCH_ACTIVE', '1')", $mysql);
				mysql_query("INSERT INTO `".$db_prefix."Settings` VALUES ('', 'SEARCH_MIN_LENGTH', '4')", $mysql);
				mysql_query("INSERT INTO `".$db_prefix."Settings` VALUES ('', 'TEMPLATE', 'default')", $mysql);
				
				//Passwort anpassen
				$pw = new baruPassword;
				$hashedPassword = $pw->hashPassword("super@user.com", "barucms"); // F�r Super User
				mysql_query("UPDATE `".$db_prefix."User` SET `Passwort` = '".$hashedPassword."' WHERE ID = '1'", $mysql);
				?>
			</div>
		</div>
		<div id="bottom" align=center>
			<button class="bBack" onClick="zurueck()" style="">Zur�ck...</button>
			&nbsp;&nbsp;
			<button class="bNext" onClick="weiter()" style="">Weiter...</button>
		</div>
	</div>
	<div id="footer">
		<small>&copy; Felix Deil 2012-2013 - Installer-Version: 1.0.2 - Baru CMS version: 0.6</small>
	</div>
</body>
</html>