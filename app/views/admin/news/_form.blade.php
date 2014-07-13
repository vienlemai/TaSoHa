<?php
echo Former::text('title')
    ->label(trans('common.title'))
    ->class('form-control');
?>
<?php
echo Former::textarea('content')
    ->label(trans('common.content'))
    ->id('ck-editor')
?>