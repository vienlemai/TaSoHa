$(document).ready(function() {
	$('#go-top').on('click', function() {
		Helper.scoll_to_top();
		return false;
	});
	$("ul.marquee").liScroll();
	$('li.dropdown').mouseover(function() {
		$(this).addClass('open');
	});
	$('li.dropdown').mouseleave(function() {
		$(this).removeClass('open');
	});


});