<?php
namespace App\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class OrderStoreRequest
{
    /**
     * @return Assert\Collection
     */
    public static function getCollections()
    {
        return new Assert\Collection([
            'name' => new Assert\Collection([
                'first_name' => new Assert\Length(['min' => 12]),
                'last_name' => new Assert\Length(['min' => 1]),
            ]),
        ]);
    }
}