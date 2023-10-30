<?php
namespace App\Services;


class CustomerService {

    /**
     * @var
     */
    private $repository;

    /**
     *
     */
    public function __construct(/*Repository $repository*/)
    {
        //$this->repository = $repository;
    }

    public function firstOrCreate($name, $since, $revenue){

    }
}