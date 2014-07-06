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
        var detailLink = '<br><a href="#" class="btn btn-default btn-xs pull-right btn-view-member-detail"><i class="fa fa-eye"></i> Chi tiết</a>';
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
});