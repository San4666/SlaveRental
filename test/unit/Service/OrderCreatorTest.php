<?php


namespace TestUnit\Service;


use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SlaveRental\Entity\Order;
use SlaveRental\Exception\SlaveBookedException;
use SlaveRental\Repository\IOrderRepository;
use SlaveRental\Service\OrderCalculator;
use SlaveRental\Service\OrderCanceler;
use SlaveRental\Service\OrderCreator;
use SlaveRental\Service\OrderIntersect;
use SlaveRental\Service\OrderSearcher;

class OrderCreatorTest extends TestCase
{
    /** @var OrderCreator */
    private $orderCreator;

    /** @var MockObject|OrderCalculator */
    private $orderCalculator;

    /** @var MockObject|IOrderRepository */
    private $orderRepository;

    /** @var MockObject|OrderIntersect */
    private $orderIntersect;


    public function setUp()
    {
        $this->orderCalculator = $this->createMock(OrderCalculator::class);
        $this->orderRepository = $this->createMock(IOrderRepository::class);
        $this->orderIntersect = $this->createMock(OrderIntersect::class);

        $this->orderCreator = new OrderCreator(
            $this->orderCalculator,
            $this->orderRepository,
            $this->orderIntersect
        );
    }


    public function testCreateSuccessfully()
    {
        $order = new Order();

        $this->orderRepository
            ->expects($this->once())
            ->method('create')
            ->with($order);

        $this->orderIntersect
            ->expects($this->once())
            ->method('trySolveIntersect')
            ->with($order)->willReturn(true);

        $this->orderCalculator
            ->expects($this->once())
            ->method('calculate')
            ->with($order)
            ->willReturn(100);

        $this->orderCreator->create($order);
    }

    public function testCreateFail()
    {
        $order = new Order();

        $this->orderRepository
            ->expects($this->never())
            ->method('create')
            ->with($order);

        $this->orderIntersect
            ->expects($this->once())
            ->method('trySolveIntersect')
            ->with($order)->willReturn(false);

        $this->orderCalculator
            ->expects($this->never())
            ->method('calculate')
            ->with($order)
            ->willReturn(100);

        $this->expectException(SlaveBookedException::class);

        $this->orderCreator->create($order);


    }


}