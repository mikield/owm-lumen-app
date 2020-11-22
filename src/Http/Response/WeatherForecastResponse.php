<?php

namespace WeatherApp\Http\Response;

use Cmfcmf\OpenWeatherMap\WeatherForecast;
use Illuminate\Http\JsonResponse;
use WeatherApp\Http\Request\GetWeatherForecastRequest;

class WeatherForecastResponse extends JsonResponse
{
    public function __construct(WeatherForecast $weatherForecast, GetWeatherForecastRequest $request)
    {
        $forecasts = [];
        foreach ($weatherForecast as $key => $forecast) {
            if ($key > $request->days) {
                break;
            }
            $forecasts[$forecast->time->from->format("M-j H:i:s")] = [
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