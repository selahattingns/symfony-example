<?php
namespace App\Requests;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Contracts\Translation\TranslatorInterface;

class OrderStoreRequest
{
    /**
     * @return Assert\Collection
     */
    public static function getCollections()
    {
        return new Assert\Collection([
            'customer_id' => [
                new Assert\Required(),
                new Assert\Type('numeric'),
                new Assert\GreaterThanOrEqual(1)
            ],
            'items' => new Assert\Required([
                new Assert\NotBlank(),
                new Assert\Type('array'),
                new Assert\All([
                    new Assert\Collection([
                        'product_id' => [
                            new Assert\NotBlank(),
                            new Assert\Type('numeric'),
                            new Assert\GreaterThanOrEqual(1)
                        ],
                        'quantity' => [
                            new Assert\NotBlank(),
                            new Assert\Type('numeric'),
                            new Assert\GreaterThanOrEqual(1),
                        ],
                    ]),
                ]),
            ]),
        ]);
    }
}