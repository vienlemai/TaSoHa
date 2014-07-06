jQuery(document).ready(function() {
	$("#org").jOrgChart({
		chartElement: '#chart',
		dragAndDrop: false
	});

//    $('.node').on('click', function() {
//        var dataUrl = $('#url-show-member').val();
//        var memberId = $(this).find('.member-id').val();
//        var dataUrl = dataUrl.replace('-1', memberId);
//        $.ajax({
//            url: dataUrl,
//            type: 'get',
//            data: null,
//            success: function(result) {
//                $(result).modal();
//            },
//            error: function() {
//                alert('Đã có lỗi xảy ra, vui lòng thử lại');
//            }
//        });
//    });

	/* Handle mouse hover on tree nodes */
	$('.members-tree-wrap .node').each(function() {
		var $_this = $(this);
		var $_input = $(this).find('input');
//        var template = '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>';
		var dismissBtn = '<button type="button" class="close" data-toggle="popover">×</button>';
		var detailLink = '<a href="#" class="btn btn-default btn-xs btn-view-member-detail"><i class="fa fa-eye"></i> Chi tiết</a>';
		var addNodeLink = '<a href="#" class="btn btn-success btn-xs btn-add-node"><i class="fa fa-plus"></i> Thêm thành viên</a>';
		var content = 'Họ tên: ' + $_input.data('fullname');
		var options = {
			title: 'Thông tin thành viên',
			content: content,
			placement: 'top',
			delay: {
				show: 500,
				hide: 100
			},
			trigger: 'manual'
		};
		$_this.popover(options);

		$_this.on('mouseover', function() {
			if (!$_this.hasClass('popovered')) {
				$_this.popover('show').addClass('popovered');
				$_this.next('.popover').find('.popover-title').append(dismissBtn);
				$_this.next('.popover').find('.popover-content').append('<hr>');
				if ($_this.find('input').data('addable') == 1) {
					$_this.next('.popover').find('.popover-content').append(addNodeLink);
				}
				$_this.next('.popover').find('.popover-content').append(detailLink);
			}
		});

		$_this.on('show.bs.popover', function() {
			$('.members-tree-wrap .node').not(this).popover('hide').removeClass('popovered');
		});
	});

	// Handler close popover button
	$(document).on('click', '.popover .close', function() {
		$(this).closest('.popover').prev('.node').popover('hide');
	});

	//
	$(document).on('click', '.popover .btn-view-member-detail', function() {
		var $_node = $(this).closest('.popover').prev('.node');
		var dataUrl = $('#url-show-member').val();
		var memberId = $_node.find('.member-id').val();
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
	$(document).on('click', '.popover .btn-add-node', function() {
		var $_node = $(this).closest('.popover').prev('.node');
		$_node.popover('hide');
		var memberID = $_node.find('input').val();
		var $_modal = $('#modal-add-node');
		$_modal.find('input[name="parent_id"]').val(memberID);
		$('#modal-add-node').modal('show');
	});
	$(document).on('submit', '#form-create-member', function(e) {
		var action = $(this).attr('action');
		$.ajax({
			url: action,
			type: 'post',
			dataType: 'json',
			data: $(this).serialize(),
			success: function(data) {
				if (data.status == false) {
					var $alert = $('#modal-add-node').find('.alert');
					var errorHtml = '<ul>';
					for (var i in data.errors) {
						errorHtml += data.errors[i];
					}
					errorHtml += '</ul>';
					$alert.find('span.msg-content').html(errorHtml);
					$alert.show();
				} else {
					window.location.href = data.redirect;
				}
			},
			error: function(e) {
				alert('Đã có lỗi xảy ra, vui lòng thử lại');
			}
		});
		e.preventDefault();
	});

});