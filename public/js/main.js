$(document).ready(function () {
	$(window).scroll(function() {
		var scroll   = $(window).scrollTop();
		var toTopBtn = $(".up");
		
		if (scroll >= 250) {
			toTopBtn.fadeIn('300');
		}
		else {
			toTopBtn.fadeOut('300');
		}
	});
	
	$(".up i").click(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});
});
