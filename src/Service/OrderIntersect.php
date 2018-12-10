<?php

namespace SlaveRental\Service;

use SlaveRental\Entity\Order;
use SlaveRental\ObjectValue\OrderSearch;
use SlaveRental\Repository\IOrderRepository;

class OrderIntersect
{
    /**
     * @var IOrderRepository
     */
    private $orderRepository;

    public function __construct(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /** @return Order[] */
    private function search(Order $order) : array {
        $search = new OrderSearch();
        $search->from = $order->getFrom();
        $search->to = $order->getTo();
        $search->slaveIds = [$order->getSlave()->getId()];

        return $this->orderRepository->search($search);
    }

    private function canBeDeleteOrder(Order $order, Order $orderIntersect) : bool {
        return $order->getMaster()->isVip() && !$orderIntersect->getMaster()->isVip();
    }

    private function canBeDeleteOrders(Order $order) : bool {
        foreach ($this->search($order) as  $orderIntersect) {
            if(!$this->canBeDeleteOrder($order, $orderIntersect)) {
                return false;
            }
        }

        return true;
    }

    public function trySolveIntersect(Order $order): bool {
        if($this->canBeDeleteOrders($order)) {
            foreach ($this->search($order) as  $orderIntersect) {
                $this->orderRepository->delete($orderIntersect);
            }
        }
    }
}