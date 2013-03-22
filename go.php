<?php include "system/config.php"; ?>
<html>
<head>
	<style type="text/css">
	#goto-box{
	 height: 200px; /* Höhe der div-Box */
	 width: 500px; /* Breite der div-Box */
	 margin-top: -100px; /* Damit der "Ausrichtungspunkt" in der Mitte der Box liegt */
	 margin-left: -250px;
	 position: absolute; /* positionieren */
	 top: 50%; /* in die Mitte verschieben */
	 left: 50%;
	 
	 /* weitere Angaben */
	 background-color: grey;
	 border-radius: 5px;
	 box-shadow: 0px 0px 20px black;
	}
	
	html{
		background: url('img/bg.png');
	}
	
	.away{
		-moz-transition-property: margin-top;
		-moz-transition-duration: 2s;
		-moz-transition-timing-function: ease;
		margin-top: -800!important;
	}
	</style>
	<script>
	var SecVar = 2; // Zeit (in Sekunden)
	var UrlVar = "<?php echo $_GET["url"]; ?>"; // Weiterleitungs-URL
	var SetInt = window.setInterval("redirCont()", 1000);

	function redirCont(){
		SecVar--;
		if(SecVar > 1){
			//document.getElementById('sekunden').innerHTML=SecVar+" Sekunden";
		}
		if(SecVar == 1){
			//document.getElementById('sekunden').innerHTML=SecVar+" Sekunde";
		}
		if(SecVar==0){
			//document.getElementById('sekunden').innerHTML="jetzt";
			window.clearInterval(SetInt);
			weiterleitung();
		}
	}
	
	function weiterleitung2(){
		document.location.href = "<?php echo $_GET["url"]; ?>";
	}
	function weiterleitung(){
		url = "<?php echo $_GET["url"]; ?>";
		$("#goto-box").addClass("away");
		setTimeout(weiterleitung2, 2000);
	}
	</script>
</head>
<body>
	<div id="goto-box">
		<center>
			<h2>&nbsp;&nbsp;<?php echo $lang_weiterleiten1; ?> <span id="sekunden">3</span> <?php echo $lang_weiterleiten2; ?>&nbsp;&nbsp;</h2>
			<b><?php echo "<a href='#' onclick='weiterleitung()'>".$_GET["url"]."</a>"; ?></b>
			<br><br>
			<small><?php echo $lang_keineHaftung; ?></small>
		</center>
	</div>
</body>
</html>