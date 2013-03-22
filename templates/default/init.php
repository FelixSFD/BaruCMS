<!-- init.php is the main file for your template -->
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
</script>
<style>
*{
	font-family: Myriad Pro, Calibri;
}

/* Menu-styles */
#menu ul, #menu li{
	list-style-type:none;
	text-decoration: none;
}

#menu{
	width: 15%;
	position: absolute;
	left: 10px;
	margin-left: -39px;
}
#menu a{
	color: black;
	text-decoration: none;
}

/* Startpage */
.pagePreview{ /* Article-previews list */
	width: 100% !important;
}

.vorschau{ /* article-preview */
	border-bottom: 1px dotted black;
	width: 100%;
	position: relative;
	margin-top: 15px;
	max-height: 240px;
}

.vorschau h3{
	line-height: 0.2;
}

.vorschau .date{
	font-size: 10pt;
	line-height: 0.1;
	color: grey;
}

.readmoreLink{ /* "read more..." */
	font-size: 9pt;
}

/* Search */
#search input{
	border-radius: 10px;
	position: absolute;
	top: 18px;
	right: 18px;
}

/* Main content */
#content, #searchResults{
	position: absolute;
	right: 10px;
	width: 80%;
	background: #CCC;
	border-radius: 15px;
	padding: 8px 8px 8px 8px;
	margin-top: -50px;
}

#welcome{ /* Welcome-text on startpage */
	border-bottom: 1px solid black;
}

/* Footer */
#footer{
	position: fixed;
	left: 10px;
	bottom: 5px;
	width: 15%;
	opacity: 0.7;
}

#footer:hover{
	opacity: 1;
}

#footer a{
	color: #eee;
}


/* Header */
#header{
	border-radius: 15px;
}
</style>