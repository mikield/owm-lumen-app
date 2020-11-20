<?php

namespace WeatherApp\Provider;

use Illuminate\Support\ServiceProvider;
use WeatherApp\Contracts\WeatherServiceContract;
use WeatherApp\Service\OpenWeatherMap\OpenWeatherMapService;

class ApplicationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(WeatherServiceContract::class, OpenWeatherMapService::class);
    }
}
