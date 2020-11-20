<?php

namespace WeatherApp\Traits;

use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Http\Request;
use RuntimeException;

trait Validation
{
    /**
     * Validate request using rules
     *
     * @param Request $request
     * @param array $rules
     *
     * @throws ValidationException
     */
    public function validate(Request $request, array $rules)
    {
        /** @var Factory $validationFactory */
        $validationFactory = app("validator");
        if (!$validationFactory) {
            throw new RuntimeException("No validation factory provided for request");
        }
        $validation = $validationFactory->make($request->all(), $rules);

        $validation->validate();
    }

}