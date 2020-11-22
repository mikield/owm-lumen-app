<?php

namespace WeatherApp\Service\OpenWeatherMap;

use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception;
use Cmfcmf\OpenWeatherMap\WeatherForecast;
use Http\Adapter\Guzzle6\Client;
use Http\Factory\Guzzle\RequestFactory;
use RuntimeException;
use WeatherApp\Contracts\WeatherServiceContract;

class OpenWeatherMapService implements WeatherServiceContract
{
    private const DEFAULT_UNITS = "metric";
    private const DEFAULT_LANG = "en";
    private OpenWeatherMap $OWMClient;

    public function __construct(RequestFactory $requestFactory, Client $client)
    {
        $apiKey = config("app.open_weather_map_api_key", env("OWM_API_KEY", null));
        if (!$apiKey) {
            throw new RuntimeException("API key for Open Weather Map not found");
        }
        $this->OWMClient = new OpenWeatherMap($apiKey, $client, $requestFactory);
    }

    /**
     * Get weather forecast for 5 days
     *
     * @param $query
     * @param int $days
     * @return WeatherForecast
     */
    public function getWeatherForecast($query, int $days): WeatherForecast
    {
        if ($days < 1 || $days > 5) {
            throw new RuntimeException("Days range is not valid");
        }
        try {
            return $this->OWMClient->getWeatherForecast($query, self::DEFAULT_UNITS, self::DEFAULT_LANG, "", $days);
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

}
