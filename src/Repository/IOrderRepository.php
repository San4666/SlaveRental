<?php
namespace SlaveRental\Repository;

use SlaveRental\Entity\Order;
use SlaveRental\ObjectValue\OrderSearch;

interface IOrderRepository
{
    function create(Order $order): void;

    function delete(Order $order): void;

    /** @return Order[] */
    function search(OrderSearch $search) : array;
}