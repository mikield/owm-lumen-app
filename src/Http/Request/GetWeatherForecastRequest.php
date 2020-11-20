<?php

namespace WeatherApp\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Http\Request;
use WeatherApp\Contracts\ApplicationHttpRequest;
use WeatherApp\Traits\Validation;

class GetWeatherForecastRequest implements ApplicationHttpRequest
{
    use Validation;

    public int $days;
    public string $locationQuery;

    /**
     * GetWeatherForecastRequest constructor.
     * @param Request $request
     * @throws ValidationException
     */
    public function __construct(Request $request)
    {
        $this->validate($request, [
            "days" => "required",
            "location_query" => ["required", Rule::in(["London,us"])]
        ]);

        $this->days = $request->input("days");
        $this->locationQuery = $request->input("location_query");
    }
}