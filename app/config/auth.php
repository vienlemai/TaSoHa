<?php

return array(
    'multi' => array(
        'member' => array(
            'driver' => 'database',
            'table' => 'members'
        ),
        'admin' => array(
            'driver' => 'eloquent',
            'model' => 'Admin'
        )
    ),
    'reminder' => array(
        'email' => 'emails.auth.reminder',
        'table' => 'password_reminders',
        'expire' => 60,
    ),
);
