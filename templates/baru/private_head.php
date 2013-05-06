<title><?php echo $this->_["title"]; ?></title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style>
#header{
	background: url('img/header.png');
}

html{
	background: url('img/bg.png');
}
</style>
<link href="templates/baru/style.css" rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans:300,400' rel='stylesheet' type='text/css'>
<?php echo $this->_["headerIncludes"]; ?>
<!-- Socialshareprivacy -->
<script type="text/javascript" src="system/jQuery/plugins/socialshareprivacy/jquery.socialshareprivacy.js"></script>
<script>
// jQuery for the menu
jQuery.fn.baruMenu = function(){ // THIS LINE MUST  NOT BE CHANGED!
	$(".layer2").hide();
	open; // Variable "open" deklarieren
	$(".layer1").click(function(){
		var clickedID = $(this).data("id");
		var status = $(this).data("status");
		console.log("Link clicked: "+clickedID+" | Status: "+status);
		
		$(".open").children("ul").slideUp();
		if(status == "open"){
			$(this).data("status", "closed");
			$(this).children("ul").slideUp();
			console.log("Status (Link: "+clickedID+") changed to 'closed'");
			open = 0;
		} else {
			$(this).data("status", "open");
			$(this).children("ul").slideDown();
			console.log("Status (Link: "+clickedID+") changed to 'open'");
			open = clickedID;
			$(this).addClass("open");
		}
	});
} // THIS LINE MUST  NOT BE CHANGED!

// You can add addtitional functions here:

$(document).ready(function() { 
	$('#socialshareprivacy').socialSharePrivacy();
	$('#main-menu').menu();
});
</script>