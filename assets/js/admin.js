CKEDITOR.replace('ck-editor');
$(document).on('click', 'a[data-method="delete"]', function() {
	var dataConfirm = $(this).attr('data-confirm');
	var token = $(this).attr('data-token');
	var action = $(this).attr('href');
	bootbox.confirm(dataConfirm, 'Hủy bỏ', 'Đồng ý', function(result) {
		if (result) {

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
	});
	return false;
});