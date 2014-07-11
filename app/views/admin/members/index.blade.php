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
            <div class="table-header">
                <div class="btn-group">
                    <button type="button" class="btn btn-default">Chọn kiểu hiển thị</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo route('admin.members.index') ?>">Danh sách</a></li>
                        <li><a href="<?php echo route('admin.members.tree', 'binary') ?>">Cây nhị phân</a></li>
                        <li><a href="<?php echo route('admin.members.tree', 'sun') ?>">Cây mặt trời</a></li>
                    </ul>
                </div>
                <a href="{{route('admin.members.create')}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Thêm mới thành viên cấp 1
                </a>
                <div class="col-md-4 pull-right no-padding">
                    <?php
                    echo View::make('admin.partials.search_tool', array(
                        'input' => $input,
                    ))->render();

                    ?>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Tên đăng nhập</th>
                        <th>Ngày tạo</th>
                        <th style="width: 15%"><?php echo trans('messages.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = $members->getFrom(); ?>
                    <?php foreach ($members as $member): ?>
                        <tr>
                            <td><?php echo $index++ ?></td>
                            <td><?php echo $member->full_name ?></td>
                            <td><?php echo $member->email ?></td>
                            <td><?php echo $member->username ?></td>
                            <td><?php echo $member->created_at->format('d \t\h\á\n\g m, Y, H:i') ?></td>
                            <td>
                                <a href="<?php echo route('admin.members.show', $member->id) ?>" class="text-primary btn-view-member-detail">
                                    <i class="fa fa-search">Xem chi tiết</i>
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php
            echo View::make('admin.partials.table_paging', array(
                'collection' => $members,
            ))->render();

            ?>
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