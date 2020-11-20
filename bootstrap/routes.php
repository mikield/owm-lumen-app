<?php

/** @var Application $app */

use Laravel\Lumen\Application;
use Laravel\Lumen\Routing\Router;
use WeatherApp\Http\Request\GetWeatherForecastRequest;
use WeatherApp\Http\Response\WeatherForecastResponse;
use WeatherApp\Service\OpenWeatherMap\OpenWeatherMapService;

$app->router->group(["middleware" => "throttle:60,1", "prefix" => "api/v1"], function (Router $router) {
    $router->get('/weather/forecast', function (
        GetWeatherForecastRequest $request,
        OpenWeatherMapService $openWeatherMapService
    ): WeatherForecastResponse {
        $forecast = $openWeatherMapService->getWeatherForecast($request->city, $request->days);
        return new WeatherForecastResponse($forecast);
    });
});
