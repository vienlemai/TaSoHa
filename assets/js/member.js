jQuery(document).ready(function() {
    $("#org").jOrgChart({
        chartElement: '#chart',
        dragAndDrop: false
    });

    /* Handle mouse hover on tree nodes */
    $('.members-tree-wrap .node').each(function() {
        var $_this = $(this);
        var $_input = $(this).find('input');
//        var template = '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>';
        var dismissBtn = '<button type="button" class="close" data-toggle="popover">×</button>';
        var detailLink = '<a href="#" class="btn btn-default btn-xs btn-view-member-detail"><i class="fa fa-eye"></i> Chi tiết</a>';
        var addNodeLink = '<a href="#" class="btn btn-success btn-xs btn-add-node"><i class="fa fa-plus"></i> Thêm thành viên</a>';
        var popoverContent = 'Họ tên: ' + $_input.data('fullname');
        var popoverTitle = 'Thông tin thành viên' + dismissBtn;
        popoverContent += '<br>';

        if ($_this.find('input').data('addable') == 1) {
            popoverContent += addNodeLink;
        }
        popoverContent += detailLink;

        var options = {
            title: popoverTitle,
            content: popoverContent,
            placement: 'top',
            delay: {
                show: 700,
                hide: 100
            },
            trigger: 'manual',
            html: true
        };
        $_this.popover(options);
        
        // Handler mouse hover with delay
        var timer;
        $_this.on('mouseover',function() {
            if (timer) {
                clearTimeout(timer);
                timer = null;
            }
            timer = setTimeout(function() {
                if ($_this.is(':hover') && !$_this.hasClass('popovered')) {
                    $_this.popover('show').addClass('popovered');
                }
            }, 500);
        });
        
        $_this.on('show.bs.popover', function() {
            $('.members-tree-wrap .node').not(this).popover('hide').removeClass('popovered');
        });
    });

    // Handler close popover button
    $(document).on('click', '.popover .close', function() {
        $(this).closest('.popover').prev('.node').popover('hide').removeClass('popovered');
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
        return false;
    });

    $(document).on('click', function(e) {
        e.stopPropagation();
        if ($(e.target).closest('.popover').length === 0) {
            $('.members-tree-wrap .node.popovered').popover('hide').removeClass('popovered');
        }
    });
});