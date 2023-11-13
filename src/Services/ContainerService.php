<?php
namespace App\Services;

use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class ContainerService implements ServiceSubscriberInterface{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * @return array|string[]
     */
    public static function getSubscribedServices(): array
    {
        return [];
    }
}