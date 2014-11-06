<?php
echo Former::open(route('member.change_password'))
    ->data_update_html_for('#change-pass-wrap')
    ->class('form-horizontal form-ajax refresh-on-success')
    ->method('post');
?>
<?php
echo Former::password('old_password')
    ->label('Mật khẩu cũ')
    ->class('form-control');
?>
<?php
echo Former::password('password')
    ->label('Mật khẩu mới')
    ->class('form-control');
?>
<?php
echo Former::password('password_confirmation')
->label('Nhập lại mật khẩu')
->class('form-control');
?>
<?php
echo Former::actions()
->primary_submit('Đồng ý');

?>
<?php echo Former::close() ?>
<div class="clear_fix"></div>

