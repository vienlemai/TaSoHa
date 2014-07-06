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
//    var timer;
//    $('.members-tree-wrap .node').hover(function() {
//        $_this = $(this);
//        if (timer) {
//            clearTimeout(timer);
//            timer = null;
//        }
//        timer = setTimeout(function() {
//            var html = '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>';
//            $_this.popover({
//                template: html
//            });
//            console.log('hovered');
//        }, 700);
//    }, function() {
//        console.log('out');
//    });

    $('.members-tree-wrap .node').each(function() {
        var $_this = $(this);
        var $_input = $(this).find('input');
//        var template = '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>';
        var content = 'Họ tên: ' + $_input.data('fullname');
        var options = {
            title: 'Thông tin thành viên',
            content: content,
            placement: 'right',
            delay: {
                show: 500,
                hide: 100
            },
            trigger: 'manual'
        };
        $_this.popover(options);

        $_this.hover(function() {
            $_this.popover('show');
        });

        $_this.on('show.bs.popover', function() {
            $('.members-tree-wrap .node').not(this).popover('hide');
        });

    });


});