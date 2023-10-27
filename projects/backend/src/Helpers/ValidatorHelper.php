<?php
namespace App\Helpers;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidatorHelper {

    /**
     * @param $validator
     * @param $request
     * @param $collections
     * @return mixed
     */
    public static function getErrors($validator, $request, $collections): ConstraintViolationListInterface
    {
        return $validator->validate(
            JsonHelper::requestDecode($request),
            $collections
        );
    }
}