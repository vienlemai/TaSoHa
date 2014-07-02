<?php

use Illuminate\Support\Facades\Facade;

class ClientPassword extends Facade {

    protected static function getFacadeAccessor() {
        return 'client.reminder';
    }

}
