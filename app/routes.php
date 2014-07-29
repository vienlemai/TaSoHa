<?php

require __DIR__ . '/routes/frontend_routes.php';
require __DIR__ . '/routes/admin_routes.php';
require __DIR__ . '/routes/member_routes.php';

Route::get('/len-la-len', 'UpdateController@up');
Route::get('test-member', function() {
    $member = Member::find(8);
    $ancestors = Member::with(array('children' => function($query) {
            $query->select(array('id', 'full_name','parent_id'));
        }))
        ->where('lft', '<=', $member->lft)
        ->where('rgt', '>=', $member->rgt)
        ->where('id', '!=', $member->id)
        ->get(array('id', 'full_name', 'parent_id'));
    var_dump($ancestors->toArray());
    //var_dump($member->getAncestors(array('id','full_name','parent_id','lft','rgt','depth'))->toHierarchy()->toArray());
});
