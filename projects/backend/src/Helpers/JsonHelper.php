<?php
namespace App\Helpers;

use Symfony\Component\HttpFoundation\Request;

class JsonHelper {

    /**
     * @param $request
     * @param $key
     * @return mixed|null
     */
    public static function getValueForRequest($request, $key)
    {
        return self::requestDecode($request)[$key] ?? null;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public static function requestDecode(Request $request)
    {
        return self::decode($request->getContent());
    }

    /**
     * @param $data
     * @return mixed
     */
    public static function decode($data)
    {
        return json_decode($data, true);
    }
}