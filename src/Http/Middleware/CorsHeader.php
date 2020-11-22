<?php

namespace WeatherApp\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Laravel\Lumen\Http\Request;

class CorsHeader
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return Response
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->getMethod() !== "OPTIONS") {
            /** @var Response $response */
            $response = $next($request);
        } else {
            $response = response()->make();
        }

        $headers = [
            "Access-Control-Allow-Origin" => "*",
            "Access-Control-Request-Method" => "*",
            "Access-Control-Request-Headers" => "*"
        ];
        return response($response->getContent(), $response->getStatusCode(), $headers);

    }

}
