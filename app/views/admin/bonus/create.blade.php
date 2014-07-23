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
                    ->label('Số điểm')
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
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-user"></i>
                <h3 class="box-title">Thông tin thành viên</h3>
            </div>
            <div class="box-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Mã số</td>
                            <td><?php echo $member->uid ?></td>
                        </tr>
                        <tr>
                            <td>Họ tên</td>
                            <td><?php echo $member->full_name ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $member->email ?></td>
                        </tr>
                        <tr>
                            <td>Ngày tham gia</td>
                            <td><?php echo $member->created_at->format('d \t\h\á\n\g m, Y') ?></td>
                        </tr>
                        <tr>
                            <td>Ngày sinh</td>
                            <td><?php echo $member->day_of_birth ?></td>
                        </tr>
                        <tr>
                            <td>Chỗ ở hiện tại</td>
                            <td><?php echo $member->location ?></td>
                        </tr>
                        <tr>
                            <td>Điện thoại</td>
                            <td><?php echo $member->phone; ?></td>
                        </tr>
                        <tr>
                            <td>Chứng minh nhân dân</td>
                            <td><?php echo $member->identify_number; ?></td>
                        </tr>
                        <tr>
                            <td>Nơi cấp</td>
                            <td><?php echo $member->identify_location; ?></td>
                        </tr>
                        <tr>
                            <td>Ngày cấp</td>
                            <td><?php echo $member->identify_date; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop