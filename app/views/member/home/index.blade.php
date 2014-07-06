@section('content')
<!--<div class="breadcrumb-wrap">
    <ul class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="#">Trang chủ</a></li>
        <li><a href="#">Cá nhân</a></li>
        <li class="active">Thành viên</li>
    </ul>
</div>-->
<?php echo View::make('layouts/frontend/_flash')->render() ?>
<h3><i class="fa fa-certificate"></i> Thông tin hoa hồng</h3>
<hr>
<div id="bonus-overview-wrap">
    <div class="pull-right margin-bottom-10">
        <form action='<?php echo route('member.filter_bonus') ?>' class='form-inline form-ajax' data-update-html-for='#bonus-info-wrap' method='GET'>
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
<h3><i class="fa fa-sitemap"></i> Sơ đồ thành viên</h3>
<hr>
<div class="members-tree-wrap primary">
    <ul id="org" style="display:none">
        <?php echo $treeData ?>
    </ul>
    <input id="url-show-member" type="hidden" name="" value="<?php echo route('member.show', -1) ?>"/>
    <div id="chart" class="orgChart"></div>
</div>

<div id="modal-add-node" class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Thêm mới thành viên</h3>
            </div>
            <div class="modal-body">
                <?php
                echo Former::open(route('admin.members.store'))->method('post');
                echo Former::hidden('parent_id');
                echo Former::text('full_name')
                        ->label('Họ tên')
                        ->class('form-control');
                echo Former::text('email')
                        ->label('email')
                        ->class('form-control');
                echo Former::text('username')
                        ->label('Tên đăng nhập')
                        ->class('form-control');
                echo Former::password('password')
                        ->label('Mật khẩu')
                        ->class('form-control');
                echo Former::password('password_confirmation')
                        ->label('Nhập lại mật khẩu')
                        ->class('form-control');
                echo Former::radios('sex')
                        ->label('Giới tính')
                        ->radios(array(
                            'Nam' => array('name' => 'sex', 'value' => 0),
                            'Nữ' => array('name' => 'sex', 'value' => 1),
                ));
                echo Former::actions()
                        ->primary_submit(Lang::get('messages.save'))
                        ->inverse_reset(Lang::get('messages.reset'));
                ?>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Đóng</button>            
            </div>
        </div>
    </div>
</div>


@stop