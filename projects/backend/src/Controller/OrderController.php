<?php

namespace App\Controller;

use App\Helpers\RedirectHelper;
use App\Helpers\ValidatorHelper;
use App\Requests\OrderStoreRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderController extends AbstractController
{
    /**
     * @Route("/api/orders", name="orderStore", methods={"POST"})
     */
    public function store(Request $request, ValidatorInterface $validator): Response
    {
        $errors = ValidatorHelper::getErrors($validator, $request, OrderStoreRequest::getCollections());
        if ($errors->count()) return RedirectHelper::validatorMessagesWithResponse($errors);

        return $this->json('123123123');
    }

    /**
     * @Route("/api/calculate-discount", name="calculateDiscount", methods={"GET"})
     */
    public function calculateDiscount(): Response
    {
        return $this->json(2345345345);
    }
}
