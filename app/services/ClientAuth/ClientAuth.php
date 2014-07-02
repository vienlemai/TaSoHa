<?php

use Illuminate\Support\Facades\Facade;

class ClientAuth extends Facade {

    protected static function getFacadeAccessor() {
        return 'client.auth';
    }

}
