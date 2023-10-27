<?php
namespace App\Helpers;

use Symfony\Component\HttpFoundation\Request;

class JsonHelper {

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