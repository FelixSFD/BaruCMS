$(document).ready(function() {
    $(document).click(function(e) {
		var $target = $(e.target);
		var isModalBox = (e.target.className == 'dropdownMenu');

		if (!isModalBox) {
			$('.dropdownMenu:visible').animate({
				"margin-top": "-15px"
				}, 75, function() {
				$(this).fadeOut(75);
			});
		}
		});

		$('a').click(function(e) {
			e.stopPropagation();
		});

		$('.userDropdown').click(function(e) {
			e.preventDefault();
		$('.dropdownMenu').show().animate({
			"margin-top": "0px"
		}, 75);
	});
});