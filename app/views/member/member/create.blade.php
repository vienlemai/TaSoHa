<h4>Thêm mới thành viên</h4>
<?php
echo Former::open(route('admin.members.store'))->method('post');
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
