<?php
namespace App\Interfaces;

interface CustomerInterface {

    /**
     * @param $name
     * @param $since
     * @param $revenue
     * @return mixed
     */
    public function firstOrCreate($name, $since, $revenue);
}