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
	}}).on('select_node.jstree', function(e, data) {
	console.log(data);
});