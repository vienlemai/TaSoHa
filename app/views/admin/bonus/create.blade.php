@section('header_content')
<h1>
    Quản lý thành viên
    <small>Nhập hoa hồng</small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active">Hoa hồng</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-user"></i>
                <h3 class="box-title">Thông tin thành viên</h3>
            </div>
            <div class="box-body">
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 30%">Họ tên</td>
                            <td>: <?php echo $member->full_name ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: <?php echo $member->email ?></td>
                        </tr>
                        <tr>
                            <td>Tên đăng nhập</td>
                            <td>: <?php echo $member->username ?></td>
                        </tr>
                        <tr>
                            <td>Ngày sinh</td>
                            <td>: <?php echo $member->day_of_birth ?></td>
                        </tr>
                        <tr>
                            <td>Giới tính</td>
                            <td>: <?php echo $member->getSexName(); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Hoa hong-->
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-money"></i>
                <h3 class="box-title">Nhập hoa hồng cho thành viên <?php echo $member->full_name ?></h3>
            </div>
            <?php echo Former::open(route('admin.bonus.store', $member->id)) ?>
            <div class="box-body">
                <?php
                echo Former::select('bonus_id')
                    ->label('Chọn loại hoa hồng')
                    ->class('form-control')
                    ->options($bonus);
                echo Former::text('amount')
                    ->label('Số tiền')
                    ->class('form-control');

                ?>
            </div>
            <div class="box-footer">
                <?php
                echo Former::actions()
                    ->primary_submit(Lang::get('messages.save'))
                    ->inverse_reset(Lang::get('messages.reset'))

                ?>
            </div>
<?php echo Former::close(); ?>
        </div>
    </div>
</div>
@stop