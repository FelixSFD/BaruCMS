function search(){
	var string = $("#searchField").val();
	if(string.length >= 3){
		jQuery.ajax({
			type: "GET",
			url: "search.php?q="+string,
			success: function(response)
			{
				if(response){
					//alert(response);
					$("#searchList").html(response);
					$("#content").hide();
					$("#searchList").show();
				} else {
					alert("Fehler beim Ausf&uuml;hren der AJAX-Anfrage!");
					$("#content").show();
					$("#searchList").hide();
				}
			}
		});
	} else {
		$("#content").show();
		$("#searchList").hide();
	}
}