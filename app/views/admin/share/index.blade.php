@section('header_content')
<h1>
    Quản lý thành viên
    <small>Cổ phần đầu tư</small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active">Cổ phần đầu tư</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-wrap">
            <div class="table-header">
                <?php if (in_array('admin.share.create', $allowed_routes)): ?>
                    <div class="col-md-2">
                        <a href="{{route('admin.share.create')}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i> Nhập cổ phần
                        </a>
                    </div>
                <?php endif; ?>
                <div class="clearfix"></div>
            </div>
            <h3>Danh sách cổ phần đầu tư</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th>Khách hàng</th>
                        <th>Số tiền</th>
                        <th>Điểm</th>
                        <th>Ngày nhập</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = $shares->getFrom();

                    ?>
                    <?php foreach ($shares as $share): ?>
                        <tr>
                            <td><?php echo $index++ ?></td>
                            <td>{{$share->member->full_name or ''}}</td>
                            <td><?php echo Common::IntToString($share->price) ?></td>
                            <td><?php echo Common::IntToString($share->score) ?></td>
                            <td><?php echo $share->created_at->format('d \t\h\á\n\g m, Y, H:i:s') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="table-footer">
                <div class="info-left">
                    <?php
                    echo trans('messages.paging_info', array(
                        'from' => $shares->getFrom(),
                        'to' => $shares->getTo(),
                        'total' => $shares->getTotal(),
                    ));

                    ?>
                </div>
                <div class="info-right">
                    <?php echo $shares->links(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@stop