<?php

return array(
    'multi' => array(
        'member' => array(
            'driver' => 'eloquent',
            'model' => 'Member'
        ),
        'admin' => array(
            'driver' => 'eloquent',
            'model' => 'AdminUser'
        )
    ),
    'reminder' => array(
        'email' => 'emails.auth.reminder',
        'table' => 'password_reminders',
        'expire' => 60,
    ),
);
