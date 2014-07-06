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
