@section('header_content')
<h1>
    Quản lý thành viên
    <small>Thông tin thành viên</small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active">Thành viên</li>
</ol>
@stop

@section('content')
<div class="row">
    <!--Hoa hong-->
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-money"></i>
                <h3 class="box-title">Thông tin hoa hồng</h3>
                <div class="box-tools pull-right">
                    <select name="month" class="form-control" id="bonus-month-select">
                        <?php foreach ($months as $m): ?>
                            <option value="<?php echo $m ?>" <?php echo $month == $m ? 'selected' : '' ?>><?php echo $m ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <input id="member-id" type="hidden" name="" value="<?php echo $member->id ?>"/>
            <div id="member-bonus-content">
                <div class="box-body">

                </div>
            </div>
            <div class="box-footer">

            </div>

        </div>
    </div>
    <?php
    echo View::make('admin.members.partials._info', array(
        'member' => $member
    ))->render();

    ?>
</div>
@stop
@section('addon_js')
<script type="text/javascript">
    var memberId = $('#member-id').val();
    var bonusUrl = baseUrl + '/member/bonus/' + memberId;
    $.ajax({
        url: bonusUrl,
        type: 'get',
        success: function(data) {
            $('#member-bonus-content').html(data);
        },
        error: function() {
            alert('Đã có lỗi xảy ra, vui lòng thử lại');
        }
    });
    $('#bonus-month-select').on('change', function() {
        var month = $(this).val();
        $.ajax({
            url: bonusUrl,
            type: 'get',
            data: {month: month},
            success: function(data) {
                $('#member-bonus-content .box-body').html(data);
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