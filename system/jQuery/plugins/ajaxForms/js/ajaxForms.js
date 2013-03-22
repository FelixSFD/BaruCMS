jQuery.fn.ajaxForms = function(responseHandling, authUsername = false, authPassword = false) {
	//$(this).children("button").addClass("ajaxButton");
	var buttonText = $(this).children("button").html();
	$(this).submit(function(){
		$(this).children("button").html("Loading...");
		$(this).children().attr("disabled", true);
		var action = $(this).attr('action');
		var form_data = {
			email: $("#email").val(),
			pw: $("#pw").val(),
			is_ajax: 1
		};
		
		jQuery.ajax({
			type: "POST",
			url: action,
			data: form_data,
			username: authUsername,
			password: authPassword,
			success: function(response)
			{
				//alert(response);
				$("#content").html(response);
			}
		});
		$(this).children("button").html(buttonText);
		$(this).children().attr("disabled", false);
		return false;
	});
};