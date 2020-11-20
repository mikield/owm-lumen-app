<?php

namespace WeatherApp\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as LumenExceptionHandler;
use Throwable;

class Handler extends LumenExceptionHandler
{
    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException) {
            return new JsonResponse([
                "message" => $e->getMessage(),
                "errors" => $e->validator->getMessageBag()->all()
            ], $e->status, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        }

        return $this->prepareJsonResponse($request, $e);
    }

}
