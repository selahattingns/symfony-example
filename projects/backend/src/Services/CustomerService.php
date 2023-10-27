<?php
namespace App\Services;

use App\Repository2\CustomerRepository;

class CustomerService {

    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function firstOrCreate($name, $since, $revenue){

    }
}