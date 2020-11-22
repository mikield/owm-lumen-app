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
    public string $city;

    /**
     * GetWeatherForecastRequest constructor.
     * @param Request $request
     * @throws ValidationException
     */
    public function __construct(Request $request)
    {
        $this->validate($request, [
            "days" => "required|min:1|max:5",
            "city" => ["required", Rule::in(["London", "Washington", "NewYork"])]
        ]);

        if ($request->input("city") == "NewYork") {
            $request->merge(["city" => "New York"]);
        }

        $this->days = $request->input("days");
        $this->city = $request->input("city");
    }
}