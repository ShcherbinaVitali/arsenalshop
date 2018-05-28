$(document).ready(function () {
	$("li.category-menu-item a").click(function () {
		console.log($(this));
		$(this).parent().toggleClass("opened");
		
		//return false;
	});
});
