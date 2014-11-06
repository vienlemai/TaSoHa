@section('header_content')
<h1>
    Quản lý cổ phần
    <small>Thưởng cổ đông</small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active">Thưởng cổ đông</li>
</ol>
@stop

@section('content')
<div class="pull-left">
    <?php if (in_array('admin.share.create', $allowed_routes)): ?>
        <a href="{{route('admin.share.create')}}" class="btn btn-sm btn-primary">
            <i class="fa fa-plus"></i> Nhập cổ phần
        </a>
    <?php endif; ?>
</div>
<div class="pull-right">
    <a href="{{route('admin.share.index')}}" class="btn btn-sm btn-primary">
        <i class="fa fa-list"></i> Danh sách cổ phần
    </a>
</div>
<div class="row">
    <div class="clearfix"></div>
    <div class="col-md-6">
        <h3>Danh sách cổ đông chờ vào giai đoạn 1</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>Họ tên</td>
                    <td>Thao tác</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($shares[0] as $share): ?>
                    <tr>
                        <td><a href="<?php echo route('admin.members.show', $share->member_id) ?>"><?php echo $share->member->full_name ?></a></td>
                        <td>
                            <form action="<?php echo route('admin.share.level') ?>" method="post">
                                <input class="" type="hidden" name="member_id" value="<?php echo $share->member_id ?>"/>
                                <input class="" type="hidden" name="level" value="1"/>
                                <button type="submit" class="btn btn-primary btn-sm">Lên C.1 </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="clearfix"></div>
    <div class="col-md-3 no-padding no-margin">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-user"></i>
                <h3 class="box-title">Gia đoạn 1</h3>
            </div>
            <div class="clearfix"></div>
            <div class="box-body">
                <?php if (!$shares[1]->isEmpty()): ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Họ tên</td>
                                <td style="width: 10%;">Thao tác</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($shares[1] as $share): ?>
                                <tr>
                                    <td><a href="<?php echo route('admin.members.show', $share->member_id) ?>"><?php echo $share->member->full_name ?></a></td>
                                    <td>
                                        <form action="<?php echo route('admin.share.level') ?>" method="post">
                                            <input class="" type="hidden" name="member_id" value="<?php echo $share->member_id ?>"/>
                                            <input class="" type="hidden" name="level" value="2"/>
                                            <button type="submit" class="btn btn-primary btn-sm">Lên C.2</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-3 no-padding no-margin">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-user"></i>
                <h3 class="box-title">Gia đoạn 2</h3>
            </div>
            <div class="clearfix"></div>
            <div class="box-body">
                <?php if (!$shares[2]->isEmpty()): ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Họ tên</td>
                                <td>Thao tác</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($shares[2] as $share): ?>
                                <tr>
                                    <td><a href="<?php echo route('admin.members.show', $share->member_id) ?>"><?php echo $share->member->full_name ?></a></td>
                                    <td>
                                        <form action="<?php echo route('admin.share.level') ?>" method="post">
                                            <input class="" type="hidden" name="member_id" value="<?php echo $share->member_id ?>"/>
                                            <input class="" type="hidden" name="level" value="3"/>
                                            <button type="submit" class="btn btn-success btn-sm">Lên C.3</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-3 no-padding no-margin">
        <div class="box box-warning">
            <div class="box-header">
                <i class="fa fa-user"></i>
                <h3 class="box-title">Gia đoạn 3</h3>
            </div>
            <div class="clearfix"></div>
            <div class="box-body">
                <?php if (!$shares[3]->isEmpty()) : ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Họ tên</td>
                                <td>Thao tác</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($shares[3] as $share): ?>
                                <tr>
                                    <td><a href="<?php echo route('admin.members.show', $share->member_id) ?>"><?php echo $share->member->full_name ?></a></td>
                                    <td>
                                        <form action="<?php echo route('admin.share.level') ?>" method="post">
                                            <input class="" type="hidden" name="member_id" value="<?php echo $share->member_id ?>"/>
                                            <input class="" type="hidden" name="level" value="4"/>
                                            <button type="submit" class="btn btn-warning btn-sm">Lên C.4 </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-3 no-padding no-margin">
        <div class="box box-danger">
            <div class="box-header">
                <i class="fa fa-user"></i>
                <h3 class="box-title">Gia đoạn 4</h3>
            </div>
            <div class="clearfix"></div>
            <div class="box-body">
                <?php if (!$shares[4]->isEmpty()): ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Họ tên</td>
                                <td>Thao tác</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($shares[4] as $share): ?>
                                <tr>
                                    <td><a href="<?php echo route('admin.members.show', $share->member_id) ?>"><?php echo $share->member->full_name ?></a></td>
                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
@stop