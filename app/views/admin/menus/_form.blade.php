<?php

echo Former::select('parent_id')
    ->label('Danh mục cha')
    ->class('select2')
    ->addOption('-- Là Menu cha -- ', null)
    ->options($menus);
echo Former::text('name')
    ->label(Lang::get('messages.menu_name'))
    ->class('form-control');
echo Former::select('type')
    ->label('Kiểu menu')
    ->id('select-menu-type')
    ->addOption('-- Chọn kiểu menu', null)
    ->options(Menu::$TYPE_LABELS);
echo Former::text('menu_content')
    ->label('Nội dung menu')
    ->readonly();
