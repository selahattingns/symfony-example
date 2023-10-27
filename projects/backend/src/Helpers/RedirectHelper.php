<?php
namespace App\Helpers;

use Symfony\Component\HttpFoundation\JsonResponse;

class RedirectHelper {

    /**
     * @param $violations
     * @return JsonResponse
     */
    public static function validatorMessagesForResponse($violations)
    {
        foreach ($violations as $violation){
            $errors[] = [
                "path" => $violation->getPropertyPath(),
                "message" => $violation->getMessage()
            ];
        }
        return (new JsonResponse(($errors ?? []), 200, [], false));
    }
}