@section('header_content')
<h1>
    Quản lý thành viên
    <small>Danh sách thành viên</small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active">Thành viên</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-wrap">
            <?php echo View::make('admin.members.partials._header_tree')->render() ?>
        </div>
    </div>
    <div class="col-md-12">
        <input id="url-show-member" type="hidden" name="" value="<?php echo route('admin.members.show', -1) ?>"/>
        <?php if ($type == 'binary'): ?>
            <div id="member-tree-binary"></div>
        <?php elseif ($type == 'sun'): ?>
            <div id="member-tree-sun"></div>
        <?php endif; ?>
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
@section('addon_js')
<script type="text/javascript">
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