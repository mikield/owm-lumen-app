<?php

namespace WeatherApp\Contracts;

use Cmfcmf\OpenWeatherMap\WeatherForecast;

interface WeatherServiceContract
{
    /**
     * Get weather forecast for 5 days
     *
     * @param $query
     * @param int $days
     * @return WeatherForecast
     */
    public function getWeatherForecast($query, int $days): WeatherForecast;
}
