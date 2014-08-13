<div class="table-header">
    <div class="btn-group">
        <button type="button" class="btn btn-default">Chọn kiểu hiển thị</button>
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
            <span class="sr-only">Chọn kiểu hiển thị</span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo route('admin.members.index') ?>">Danh sách</a></li>
            <li><a href="<?php echo route('admin.members.tree', 'binary') ?>">Cây nhị phân</a></li>
            <li><a href="<?php echo route('admin.members.tree', 'sun') ?>">Cây mặt trời</a></li>
        </ul>
    </div>
    <?php if (in_array('admin.members.create', $allowed_routes)): ?>
        <a href="{{route('admin.members.create')}}" class="btn btn-sm btn-primary">
            <i class="fa fa-plus"></i> Thêm mới thành viên
        </a>
    <?php endif; ?>
    <div class="col-md-4 pull-right no-padding">
        <?php
        echo View::make('admin.partials.search_tool', array(
            'input' => Input::all(),
            'searchUrl' => route('admin.members.index')
        ))->render();

        ?>
    </div>
</div>