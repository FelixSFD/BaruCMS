function link(target){
	document.location.href = target;
}

function loginForm(){
	$("#loginDialog").dialog("open");
	return false;
}

function logout(){
	logoutWindow = window.open("logout.php", "Logout...", "outerWidth=300,outerHeight=300,scrollbars=no,location=no,menubar=no,toolbar=no");
	return false;
}

//Download Buttons
function dlButtons(){
	var file = $("#dlButton").data("id");
	//alert(file);
	$("#dlButton").load("download/config/button.php?id="+file);
}


//Seitenauswahl im Menüeditor
function setPage(){
	var menuTarget = $("#selectPage").val();
	if(menuTarget > 0 || menuTarget == -1){
		$("#externerLinkBox").hide();
		$("#linkTarget").val(menuTarget);
	} else {
		$("#linkTarget").val("http://");
		$("#externerLinkBox").show();
	}
}