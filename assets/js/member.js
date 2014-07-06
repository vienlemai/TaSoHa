jQuery(document).ready(function() {
	$("#org").jOrgChart({
		chartElement: '#chart',
		dragAndDrop: false
	});
	$('.node').on('click', function() {
		var dataUrl = $('#url-show-member').val();
		var memberId = $(this).find('.member-id').val();
		var dataUrl = dataUrl.replace('-1', memberId);
		$.ajax({
			url: dataUrl,
			type: 'get',
			data: null,
			success: function(result) {
				$(result).modal();
			},
			error: function() {
				alert('Đã có lỗi xảy ra, vui lòng thử lại');
			}
		});
	});
});