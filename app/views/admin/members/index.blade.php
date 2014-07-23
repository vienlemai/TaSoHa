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
            <?php echo View::make('admin.members.partials._header')->render() ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 3%">#</th>
                        <th>Mã số</th>
                        <th>Họ tên</th>
                        <th>Người giới thiệu</th>
                        <th>Người quản lý</th>
                        <th>Ngày tạo</th>
                        <th style="width: 25%"><?php echo trans('messages.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = $members->getFrom(); ?>
                    <?php foreach ($members as $member): ?>
                        <tr>
                            <td><?php echo $index++ ?></td>
                            <td><?php echo $member->uid ?></td>
                            <td><?php echo $member->full_name ?></td>
                            <td>{{$member->introducer->full_name or ''}}</td>
                            <td>{{$member->parent->full_name or ''}}</td>
                            <td><?php echo $member->created_at->format('d \t\h\á\n\g m, Y') ?></td>
                            <td>
                                <a href="<?php echo route('admin.members.show', $member->id) ?>" class="text-primary">
                                    <i class="fa fa-search"> Chi tiết</i>
                                </a>
                                <a href="<?php echo route('admin.members.edit', $member->id) ?>" class="text-info">
                                    <i class="fa fa-edit"> Sửa</i>
                                </a>
                                <a href="<?php echo route('admin.bonus.create', $member->id) ?>" class="text-warning">
                                    <i class="fa fa-adjust"> Nhập hoa hồng</i>
                                </a>
                                <a href="<?php echo route('admin.members.destroy', $member->id) ?>"
                                   class="text-danger" 
                                   data-confirm="Bạn có chắc chắn muốn xóa thành viên <?php echo $member->full_name ?>"
                                   data-method="delete">
                                    <i class="fa fa-ban"> Xóa</i>
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