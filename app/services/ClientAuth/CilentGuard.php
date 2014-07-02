<?php

use Illuminate\Auth\Guard as AuthGuard;

class CilentGuard extends AuthGuard {

    public function getName() {
        return 'login_' . md5('ClientAuth');
    }

    public function getRecallerName() {
        return 'remember_' . md5('ClientAuth');
    }

}
