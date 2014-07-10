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
                        <li><a href="<?php echo route('admin.members.tree') ?>">Cây</a></li>
                    </ul>
                </div>
                <a href="{{route('admin.members.create')}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Thêm mới thành viên cấp 1
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div id="member-tree"></div>
    </div>
</div>
@stop