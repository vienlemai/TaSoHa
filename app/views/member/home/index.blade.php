@section('content')
<!--<div class="breadcrumb-wrap">
    <ul class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="#">Trang chủ</a></li>
        <li><a href="#">Cá nhân</a></li>
        <li class="active">Thành viên</li>
    </ul>
</div>-->
<?php echo View::make('layouts/frontend/_flash')->render() ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-certificate"></i> Thông tin hoa hồng</h3>
    </div>
    <div class="panel-body">
        <div id="bonus-overview-wrap">
            <div class="pull-right margin-bottom-10">
                <form action='<?php echo route('member.filter_bonus') ?>' class='form-inline form-ajax keep-offset' data-update-html-for='#bonus-info-wrap' method='GET'>
                    <label class='control-label text-bold'>Chọn tháng</label>
                    <select class='form-control input-sm submit-on-change' name='month'>
                        <?php foreach (monthsForSelect(5) as $month) : ?>
                            <option value='<?php echo $month ?>'><?php echo date('\T\h\á\n\g m \- Y', strtotime($month)) ?></option>
                        <?php endforeach; ?>
                    </select>  
                </form>
            </div>
            <div id="bonus-info-wrap">
                <?php echo View::make('member.partials._bonus_list')->with('bonus', $bonus)->render() ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-sitemap"></i> Sơ đồ thành viên</h3>
    </div>
    <div class="panel-body">
        <div class="btn-group">
            <button type="button" class="btn btn-default">Chọn kiểu hiển thị</button>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo route('member.root', array('type'=>'binary')) ?>">Cây nhị phân</a></li>
                <li><a href="<?php echo route('member.root', array('type'=>'sun'))?>">Cây mặt trời</a></li>
            </ul>
        </div>
        <div class="members-tree-wrap primary">
            <div class="col-md-12">
                <input id="url-show-member" type="hidden" name="" value="<?php echo route('admin.members.show', -1) ?>"/>
                <?php if ($type == 'binary'): ?>
                    <div id="member-tree-binary"></div>
                <?php elseif ($type == 'sun'): ?>
                    <div id="member-tree-sun"></div>
                <?php endif; ?>
            </div>
            <input id="url-show-member" type="hidden" name="" value="<?php echo route('member.show', -1) ?>"/>
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