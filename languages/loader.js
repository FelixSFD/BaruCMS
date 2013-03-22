function neuLaden(){
	document.location.href = document.location;
}
function setLang(){
	var langID = $("#chooseLang").val();
	$("#langLoader").load("language.php?lang="+langID, neuLaden);
}