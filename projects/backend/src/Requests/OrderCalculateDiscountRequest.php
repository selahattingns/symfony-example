<?php
namespace App\Requests;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Contracts\Translation\TranslatorInterface;

class OrderCalculateDiscountRequest
{
    /**
     * @return Assert\Collection
     */
    public static function getCollections()
    {
        return new Assert\Collection([
            'order_id' => [
                new Assert\NotBlank(),
                new Assert\Type('numeric'),
                new Assert\GreaterThanOrEqual(1)
            ],
        ]);
    }
}