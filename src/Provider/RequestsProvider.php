<?php

namespace WeatherApp\Provider;

use Illuminate\Support\ServiceProvider;
use WeatherApp\Http\Request\GetWeatherForecastRequest;

class RequestsProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(GetWeatherForecastRequest::class, function () {
            return new GetWeatherForecastRequest($this->app->make("request"));
        });
    }

}