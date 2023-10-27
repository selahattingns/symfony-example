<?php
namespace App\Interfaces;

interface OrderInterface {

    /**
     * @param $customerId
     * @param $total
     * @return mixed
     */
    public function firstOrCreate($customerId, $total);

    /**
     * @param $customerId
     * @param $total
     * @return mixed
     */
    public function create($customerId, $total);

    /**
     * @param $id
     * @return mixed
     */
    public function findWithItems($id);

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param $id
     * @param $total
     * @return mixed
     */

    public function updateWithId($id, $total);

    /**
     * @param $customerId
     * @param $items
     * @return mixed
     */

    public function newOrder($customerId, $items);
}