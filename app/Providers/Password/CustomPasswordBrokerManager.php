<?php

namespace App\Providers\Password;

use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Support\Str;

class CustomPasswordBrokerManager extends PasswordBrokerManager
{

    protected function createTokenRepository(array $config)
    {
        $key = $this->app['config']['app.key'];

        if (Str::startsWith($key, 'base54:')) {
            $key = base64_decode(substr($key, 7));
        }

        $connection = isset($config['connection']) ? $config['connection'] : null;

        return new CustomDatabaseTokenRepository(
            $this->app['db']->connection($connection),
            $this->app['hash'],
            $config['table'],
            $key,
            $config['expire']
        );
    }
}
