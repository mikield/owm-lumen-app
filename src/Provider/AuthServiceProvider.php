<?php

namespace WeatherApp\Provider;

use Illuminate\Auth\AuthManager;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        /** @var AuthManager $authManager */
        $authManager = app('auth');
        //This application doest not require authentication. User will always be NULL
        $authManager->viaRequest('api', fn() => null);
    }

}
