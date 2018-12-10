<?php

namespace SlaveRental\Service;

use SlaveRental\Entity\Order;
use SlaveRental\Exception\SlaveBookedException;
use SlaveRental\Repository\IOrderRepository;

class OrderCreator
{
    /**
     * @var OrderCalculator
     */
    private $orderCalculator;

    /**
     * @var IOrderRepository
     */
    private $orderRepository;

    /**
     * @var OrderIntersect
     */
    private $orderIntersect;

    public function __construct(
        OrderCalculator $orderCalculator,
        IOrderRepository $orderRepository,
        OrderIntersect $orderIntersect
    )
    {
        $this->orderCalculator = $orderCalculator;
        $this->orderRepository = $orderRepository;
        $this->orderIntersect = $orderIntersect;
    }

    /**
     * @throws SlaveBookedException
     */
    public function create(Order $order): void
    {
        if ($this->orderIntersect->trySolveIntersect($order)) {
            $this->orderCalculator->calculate($order);
            $this->orderRepository->create($order);
        } else {
            throw new SlaveBookedException("Раб занят");
        }

    }
}