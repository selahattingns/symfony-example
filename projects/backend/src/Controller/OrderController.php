<?php

namespace App\Controller;

use App\Helpers\RedirectHelper;
use App\Helpers\ValidatorHelper;
use App\Requests\OrderCalculateDiscountRequest;
use App\Requests\OrderStoreRequest;
use App\Services\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderController extends AbstractController
{
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return Response
     *
     * @Route("/api/orders", name="orderStore", methods={"POST"})
     */
    public function store(Request $request, ValidatorInterface $validator): Response
    {
        $errors = ValidatorHelper::getErrors($validator, $request, OrderStoreRequest::getCollections());
        if ($errors->count()) return RedirectHelper::validatorMessagesForResponse($errors);

        return $this->json($this->orderService->newOrder($request->request->get('customer_id'), $request->request->get('items')));
    }

    /**
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return Response
     *
     * @Route("/api/calculate-discount", name="calculateDiscount", methods={"GET"})
     */
    public function calculateDiscount(Request $request, ValidatorInterface $validator): Response
    {
        $errors = ValidatorHelper::getErrors($validator, $request, OrderCalculateDiscountRequest::getCollections());
        if ($errors->count()) return RedirectHelper::validatorMessagesForResponse($errors);

        return $this->json($this->orderService->find($request->request->get('order_id')) ?? []);
    }
}
