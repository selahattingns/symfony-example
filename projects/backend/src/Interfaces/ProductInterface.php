<?php
namespace App\Interfaces;

interface ProductInterface {

    /**
     * @param $name
     * @param $category
     * @param $price
     * @param $stock
     * @return mixed
     */
    public function firstOrCreate($name, $category, $price, $stock);

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);
}