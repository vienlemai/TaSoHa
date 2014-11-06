@section('content')
<div class="row">
    <div class="col-lg-12 pull-right">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-certificate"></i> Thông tin hoa hồng</h3>
            </div>
            <div class="panel-body" id="personal-info-wrap">
                <div class="row">
                    <div class="pull-left">
                        <h4 class="right-sub-title">Danh sách thành viên con</h4>
                    </div>
                    <div class="box-tools pull-right">
                        <select name="month" class="form-control" id="select-tree-type">
                            <option value="sun">Cây mặt trời</option>
                            <option value="binary">Cây nhị phân</option>
                        </select>
                    </div>
                </div>
                <div class="row ml20">
                    <div id="tree-sun-container" style="display: <?php echo $type == 'sun' ? 'block' : 'none' ?>">
                        <h4>Cây mặt trời</h4>
                        <div class="" id="member-tree-sun"></div>
                    </div>
                    <div id="tree-binary-container" style="display: <?php echo $type == 'binary' ? 'block' : 'none' ?>">
                        <h4>Cây nhị phân</h4>
                        <div class="" id="member-tree-binary"></div>
                    </div>
                </div>
                <input id="url-show-member" type="hidden" name="" value="<?php echo route('members.show', -1) ?>"/>
            </div>
        </div>
    </div>
</div>
<div id="modal-member-detail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Thông tin chi tiết thành viên</h3>
            </div>
            <div class="modal-body" id='form-add-node-wrap'>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Đóng</button>            
            </div>
        </div>
    </div>
</div>
@stop
@section('addon_css')
<link href="{{asset('assets/js/plugins/jstree/themes/default/style.min.css')}}" rel="stylesheet" type="text/css" />
@stop
@section('addon_js')
<script src="{{asset('assets/js/plugins/jstree/jstree.min.js')}}" type="text/javascript"></script>
@stop
@section('inline_js')
<script type="text/javascript">
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
                return node.id === '#' ? baseUrl + '/tree-binary/children' : baseUrl + '/tree-binary/children/' + node.id;
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
                return node.id === '#' ? baseUrl + '/tree-sun/children' : baseUrl + '/tree-sun/children/' + node.id;
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

$('#select-tree-type').on('change', function() {
    var type = $(this).val();
    if (type == 'sun') {
        $('#tree-sun-container').show();
        $('#tree-binary-container').hide();
    } else {
        $('#tree-sun-container').hide();
        $('#tree-binary-container').show();
    }
});
$('body').on('change', '#bonus-month-select', function() {
    var memberId = $(this).attr('data-member-id');
    var bonusUrl = baseUrl + '/member/bonus/' + memberId;
    var month = $(this).val();
    $.ajax({
        url: bonusUrl,
        type: 'get',
        data: {month: month},
        success: function(data) {
            $('#member-bonus-content').html(data);
        },
        error: function() {
            alert('Đã có lỗi xảy ra, vui lòng thử lại');
        }
    });
});
$('body').on('click', '#btn-pay-bonus', function() {
    var dataUrl = $(this).attr('href');
    var month = $(this).attr('data-month');
    $.ajax({
        url: dataUrl,
        type: 'post',
        dataType: 'json',
        data: {month: month},
        success: function(data) {
            if (data.status == 1) {
                if (confirm('Đã thanh toán thành công hoa hồng, bạn có muốn in hóa đơn ?')) {
                    location.href = data.url_print_receipt;
                }
            } else {
                alert(data.message);
                location.reload();
            }

        },
        error: function(error) {
            alert('Đã có lỗi xảy ra, vui lòng thử lại');
            return false;
        }
    });
    return false;
});

</script>
@stop