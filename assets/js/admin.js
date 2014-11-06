if (typeof (CKEDITOR) !== 'undefined') {
	CKEDITOR.replace('ck-editor');
}

$(document).off('.datepicker.data-api');
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

$('#get-monthly-bonus').on('click', function() {
	$.ajax({
		url: baseUrl + '/tinh-hoa-hong',
		type: 'post',
		dataType: 'json',
		data: null,
		success: function() {
			$('.calculate-bonus-wrap').hide();
			$('.bounus-result-wrap').show();
		},
		error: function() {
			alert('Đã có lỗi xảy ra, vui lòng thử lại');
		}
	});
});
$('#btn-reset-bill').on('click', function() {
	$.ajax({
		url: baseUrl + '/xoa-du-lieu',
		type: 'post',
		dataType: 'json',
		data: null,
		success: function(data) {
			$('.clear-result-wrap .alert').html(data.message);
			$('.calculate-bonus-wrap').hide();
			$('.clear-result-wrap').show();
		},
		error: function() {
			alert('Đã có lỗi xảy ra, vui lòng thử lại');
		}
	});
});

//Choose menu
$("#select-menu-type").on("change", function() {
	var type = $(this).val();
	var menuItem = menus[type];
	//console.log(menus[type]);return false;
	if (menuItem['menu_action'] != '') {
		var ajaxUrl = base_url + 'admin/menus/' + menuItem['menu_action'];
		$.get(ajaxUrl, function(data) {
			$("#menu-modal .modal-body").html(data);
			$("#menu-modal .modal-header h3").html('Chọn danh mục cho menu');
			loadDataTable();
			$("#menu-modal").modal();
			getMenuSelected();
		});
	} else {
		menuSelectedTitle = menus[type]['title'];
		meunuSelectedId = 0;
		$("#MenuContent").val(menuSelectedTitle);
		$("#MenuExt").val(0);
	}

//		} else if (type == 3) {
//			$("#MenuContent").val('Album ảnh');
//		} else if (type == 4) {
//			$("#MenuContent").val('Video');
//		}
	//}
});

$('#menu-modal').on('hidden.bs.modal', function() {
	var menuContent = '';
	var menuType = $("#MenuMenuType").val();
	menuContent += menus[menuType]['title'] + ' : ' + menuSelectedTitle;
	$("#MenuContent").val(menuContent);
	$("#MenuExt").val(meunuSelectedId);
});

function getMenuSelected() {
	$(".menu-check-item").on('click', function() {
		var id = $(this).val();
		$(this).prop('checked', true);
		$td = $(this).parent();
		$tdTitle = $td.siblings('.select-name');
		menuSelectedTitle = $tdTitle.html();
		meunuSelectedId = id;
		$(".menu-check-item").each(function() {
			var iid = $(this).val();
			if (iid != id) {
				$(this).prop('checked', false);
			}
		});
	});
}