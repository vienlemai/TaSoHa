
<?php
Former::populate(Auth::member()->get());
echo Former::open(route('member.update_profile'))
    ->data_update_html_for('#personal-info-wrap')
    ->class('form-horizontal form-ajax refresh-on-success')
    ->method('post');
?>
<?php
echo Former::email('email')
    ->class('form-control');
?>
<?php
echo Former::text('full_name')
    ->class('form-control');
?>
<?php
echo Former::text('day_of_birth')
    ->class('form-control');
?>
<?php
echo Former::text('phone')
    ->class('form-control');
?>
<?php
echo Former::radios('sex')
    ->label('Giới tính')
    ->radios(array(
        'Nam' => array('name' => 'sex', 'value' => 0),
        'Nữ' => array('name' => 'sex', 'value' => 1),
    ))->check(0)
    ->inline();
?>

<?php
echo Former::text('identify_number')
    ->class('form-control');
echo Former::text('identify_location')
    ->class('form-control');
echo Former::text('identify_date')
    ->class('form-control date_mask');
echo Former::text('location')
    ->class('form-control');
?>

<?php
echo Former::actions()
    ->primary_submit('Đồng ý');
?>
<?php echo Former::close() ?>
<div class="clear_fix"></div>