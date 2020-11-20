<?php

namespace WeatherApp\Contracts;

use Laravel\Lumen\Http\Request;

interface ApplicationHttpRequest
{
    public function __construct(Request $request);
}