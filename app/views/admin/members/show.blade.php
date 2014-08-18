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
                    <a href="<?php echo route('admin.bonus.create', $member->id) ?>" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Nhập hoa hồng</a>
                </div>
            </div>
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Tên hoa hồng</td>
                            <td>Tổng điểm</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bonus as $b): ?>
                            <tr>
                                <td><?php echo $b['name']; ?></td>
                                <td><?php echo $b['amount'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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