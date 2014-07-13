<?php

echo Former::text('name')
        ->label(Lang::get('messages.category_name'))
        ->class('form-control');
echo Former::textarea('description')->rows(5)
        ->label(trans('model.ArticleCategory.description'))
        ->class('form-control');
?>