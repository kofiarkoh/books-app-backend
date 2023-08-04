<?php

namespace App\Providers\Password;

use Illuminate\Auth\Passwords\DatabaseTokenRepository;

class CustomDatabaseTokenRepository extends DatabaseTokenRepository
{

    public function createNewToken()
    {
        return sprintf("%04d", mt_rand(1, 9999));
    }
}
