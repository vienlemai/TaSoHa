jQuery(document).ready(function() {
	$("#org").jOrgChart({
		chartElement: '#chart',
		dragAndDrop: false
	});
	$('.node').on('mouseover', function(e) {
		alert('hover');
	}, function(e) {

	});
});