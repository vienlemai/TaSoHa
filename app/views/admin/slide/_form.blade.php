<?php
echo Former::file('image')
    ->class('form-control input-file-bt')->placeholder(trans('common.select_a_file'))->data_browse_button_text(trans('common.browse'));
?>
<?php
echo Former::textarea('description')
        ->rows(5);
?>