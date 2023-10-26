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
        return json_decode($request->getContent(), true);
    }
}