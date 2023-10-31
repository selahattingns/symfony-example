<?php
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\QuantityException;

class QuantityExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof QuantityException) {
            $product = $exception->getProduct();
            $response = new Response("Istenildigi kadar " . ($product->getId() ?? "-") . " id'li urunden stokta kalmadi. Tum islemler geri alindi.", 400);
            $event->setResponse($response);
        }
    }
}