<?php

require __DIR__ . '/routes/frontend_routes.php';
require __DIR__ . '/routes/admin_routes.php';
require __DIR__ . '/routes/member_routes.php';

Route::get('/len-la-len', 'UpdateController@up');
Route::get('phpinfo', function() {
    echo '<pre>';
    var_dump($_SERVER);
    echo $_SERVER["PATH"];
    echo phpinfo();
});
Route::get('test-member', function() {
    $sunMember = SunMember::with('Member')
        ->where('id', 1)
        ->first();
    //$sunMember->member->increment('score',20);
    var_dump($sunMember->toArray());
});

