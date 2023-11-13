<?php

namespace App\Controller;

use App\Entity\Order;
use App\Helpers\JsonHelper;
use App\Helpers\RedirectHelper;
use App\Helpers\ValidatorHelper;
use App\Properties\Discount\DiscountProperty;
use App\Repository\OrderRepository;
use App\Requests\OrderCalculateDiscountRequest;
use App\Requests\OrderStoreRequest;
use App\Services\OrderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @param EntityManagerInterface $manager
     * @return Response
     * @throws \App\Exceptions\QuantityException
     *
     * @Route("/api/orders", name="orderStore", methods={"POST"})
     */
    public function store(Request $request, ValidatorInterface $validator, EntityManagerInterface $manager): Response
    {
        $errors = ValidatorHelper::getErrors($validator, $request, OrderStoreRequest::getCollections());
        if ($errors->count()) return RedirectHelper::validatorMessagesForResponse($errors);

        $order = $this->orderService->newOrder($manager, JsonHelper::getValueForRequest($request, "customer_id"), JsonHelper::getValueForRequest($request, "items"));

        return new JsonResponse($order ? $order->getResponse() : [], 200);
    }

    /**
     * @param Request $request
     * @param ValidatorInterface $validator
     * @param EntityManagerInterface $manager
     * @return Response
     *
     * @Route("/api/calculate-discount", name="calculateDiscount", methods={"GET"})
     */
    public function calculateDiscount(Request $request, ValidatorInterface $validator, EntityManagerInterface $manager): Response
    {
        $errors = ValidatorHelper::getErrors($validator, $request, OrderCalculateDiscountRequest::getCollections());
        if ($errors->count()) return RedirectHelper::validatorMessagesForResponse($errors);

        $order = $this->orderService->find(JsonHelper::getValueForRequest($request, "order_id")) ?? [];
        return new JsonResponse($order ? (new DiscountProperty())->getDiscounts($manager, $order) : [], 200);
    }
}
