if (typeof (CKEDITOR) !== 'undefined') {
	CKEDITOR.replace('ck-editor');
}
$('.datepicker').datepicker({
	language: 'vi',
	format: 'dd/mm/yyyy'
});
var $formGroup = $('#form-admin-group'), $formUser = $('#form-admin-user');
//select users for group
$('.select2').select2();
//form create group on submit
$('#btn-submit-group').on('click', function(e) {
	var users = $formGroup.find('#group-select-users').val();
	var $inputUsers = $("<input>")
			.attr("type", "hidden")
			.attr("name", "users").val(users);
	$formGroup.append($inputUsers).submit();
	e.preventDefault();
});
$('#btn-submit-user').on('click', function(e) {
	var groups = $formUser.find('#user-select-group').val();
	var $inputGroups = $("<input>")
			.attr("type", "hidden")
			.attr("name", "groups").val(groups);
	$formUser.append($inputGroups).submit();
	e.preventDefault();

});

$('.resource-parent input').on('click', function() {
	var $container = $(this).parents('.resource-group');
	var checkStatus = $(this).prop('checked');
	$container.find('ul.resource-children input').each(function() {
		$(this).prop('checked', checkStatus);
	});
});

$('a[data-method="delete"]').on('click', function() {
	var dataConfirm = $(this).attr('data-confirm');
	if (typeof dataConfirm === 'undefined') {
		dataConfirm = 'Are you sure ?';
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

function showMemberDetail(memberId) {
	var dataUrl = $('#url-show-member').val();
	var dataUrl = dataUrl.replace('-1', memberId);
	$.ajax({
		url: dataUrl,
		type: 'get',
		data: null,
		success: function(result) {
			$('#modal-member-detail').find('.modal-body').html(result);
			$('#modal-member-detail').modal();
		},
		error: function() {
			alert('Đã có lỗi xảy ra, vui lòng thử lại');
		}
	});
}
$('#member-tree-binary').jstree({
	'core': {
		"multiple": false,
		'data': {
			'url': function(node) {
				return node.id === '#' ? baseUrl + '/member/tree-binary/children' : baseUrl + '/member/tree-binary/children/' + node.id;
			},
			'data': function(node) {
				return {'id': node.id};
			}
		}
	}}).on('select_node.jstree', function(event, data) {
	var memberId = data.node.id;
	showMemberDetail(memberId);
	return false;
});
$('#member-tree-sun').jstree({
	'core': {
		"multiple": false,
		'data': {
			'url': function(node) {
				return node.id === '#' ? baseUrl + '/member/tree-sun/children' : baseUrl + '/member/tree-sun/children/' + node.id;
			},
			'data': function(node) {
				return {'id': node.id};
			}
		}
	}}).on('select_node.jstree', function(event, data) {
	var memberId = data.node.id;
	showMemberDetail(memberId);
	return false;
});


$(document).on('click', '.btn-view-member-detail', function() {
	var dataUrl = $(this).attr('href');
	$.ajax({
		url: dataUrl,
		type: 'get',
		data: null,
		success: function(result) {
			$('#modal-member-detail').find('.modal-body').html(result);
			$('#modal-member-detail').modal();
		},
		error: function() {
			alert('Đã có lỗi xảy ra, vui lòng thử lại');
		}
	});
	return false;
});