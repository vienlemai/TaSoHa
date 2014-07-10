if (typeof (CKEDITOR) !== 'undefined') {
	CKEDITOR.replace('ck-editor');
}
$('a[data-method="delete"]').on('click', function() {
	var dataConfirm = $(this).attr('data-confirm');
	if (typeof dataConfirm === 'undefined') {
		dataConfirm = 'Bạn có chắc chắn muốn xóa';
	}
	var token = dataToken;
	var action = $(this).attr('href');
	if (confirm(dataConfirm)) {
		var form =
				$('<form>', {
					'method': 'POST',
					'action': action
				});
		var tokenInput =
				$('<input>', {
					'type': 'hidden',
					'name': '_token',
					'value': token
				});
		var hiddenInput =
				$('<input>', {
					'name': '_method',
					'type': 'hidden',
					'value': 'delete'
				});
		form.append(tokenInput, hiddenInput).hide().appendTo('body').submit();
	}
	return false;
});
$('#member-tree').jstree({
	'core': {
		"multiple": false,
		'data': {
			'url': function(node) {
				return node.id === '#' ? baseUrl + '/member/tree/children' : baseUrl + '/member/tree/children/' + node.id;
			},
			'data': function(node) {
				return {'id': node.id};
			}
		}
	}}).on('select_node.jstree', function(event, data) {
	var curentTarget = data.event.currentTarget;
	var popoverTitle = data.node.text;
	var detailLink = '<a href="javascript:void(0)" class="btn btn-default btn-xs btn-view-member-detail" data-id="' + data.node.id + '"><i class="fa fa-eye"></i> Chi tiết</a>';
	var addNodeLink = '<a href="javascript:void(0)" class="btn btn-success btn-xs btn-add-node" data-id="' + data.node.id + '"><i class="fa fa-plus"></i> Thêm thành viên</a>';
	var popoverContent = detailLink + addNodeLink;
	var options = {
		title: popoverTitle,
		content: popoverContent,
		placement: 'right',
		trigger: 'focus',
		html: true
	};
	$(curentTarget).popover(options);
	$(curentTarget).popover('show');
});

$(document).on('click', '.popover .btn-view-member-detail', function() {
	var $_node = $(this).closest('.popover').prev('.node');
	var dataUrl = $('#url-show-member').val();
	var memberId = $(this).attr('data-id');
	var dataUrl = dataUrl.replace('-1', memberId);
	$.ajax({
		url: dataUrl,
		type: 'get',
		data: null,
		success: function(result) {
			$_node.popover('hide');
			$(result).modal();

		},
		error: function() {
			alert('Đã có lỗi xảy ra, vui lòng thử lại');
		}
	});
	return false;
});