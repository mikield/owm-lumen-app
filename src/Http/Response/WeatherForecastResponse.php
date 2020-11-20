<?php

namespace WeatherApp\Http\Response;

use Cmfcmf\OpenWeatherMap\WeatherForecast;
use Illuminate\Http\JsonResponse;

class WeatherForecastResponse extends JsonResponse
{
    public function __construct(WeatherForecast $weatherForecast)
    {
        $forecasts = [];
        foreach ($weatherForecast as $forecast) {
            $forecasts[$forecast->time->day->format("M-j")] = [
                "temperature_min" => $forecast->temperature->min->getValue(),
                "temperature_max" => $forecast->temperature->max->getValue(),
                "humidity" => $forecast->humidity->getValue()
            ];
        }
        parent::__construct([
            "forecast" => $forecasts
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

}