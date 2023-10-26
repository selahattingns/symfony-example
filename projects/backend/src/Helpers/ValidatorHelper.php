<?php
namespace App\Helpers;

class ValidatorHelper {

    /**
     * @param $validator
     * @param $request
     * @param $collections
     * @return mixed
     */
    public static function getErrors($validator, $request, $collections): mixed
    {
        return $validator->validate(
            JsonHelper::requestDecode($request),
            $collections
        );
    }
}