<?php
echo Former::open(route('member.store'))->method('post')->class('form-horizontal form-ajax refresh-on-success')->data_update_html_for('#form-add-node-wrap')
        ->id('form-create-member');
?>
<div class="form-messages"></div>
<?php
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
echo Former::text('day_of_birth')
        ->label('Ngày sinh')
        ->class('form-control datepicker');
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