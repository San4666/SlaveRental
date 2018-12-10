<?php

namespace TestUnit;

use PHPUnit\Framework\TestCase;
use SlaveRental\Entity\Order;
use SlaveRental\Service\OrderCalculator;
use SlaveRental\Service\OrderCanceler;

class OrderCalculatorTest extends TestCase
{
    /**
     * @dataProvider dataProviderCalculate
     */
    public function testCalculate(string $from, string $to, int $workHours)
    {
        $order = new Order();
        $order->setFrom(new \DateTime($from));
        $order->setTo(new \DateTime($to));

        $orderCalculator = new OrderCalculator();

        $this->assertSame($workHours, $orderCalculator->calculateWorkHours($order));
    }


    public function dataProviderCalculate()
    {

        return [
            ['2017-01-01 03:00:00','2017-01-01 04:00:00',1],
            ['2017-01-01 03:00:00','2017-01-01 05:00:00',2],
            ['2017-01-01 00:00:00','2017-01-01 16:00:00',16],
            ['2017-01-01 00:00:00','2017-01-01 23:00:00',16],
            ['2017-01-01 00:00:00','2017-01-02 0:00:00',16],
            ['2017-01-01T00:00:00','2017-01-02T01:00:00',17],
            ['2017-01-01T00:00:00','2017-01-20T00:00:00',19*16],
            ['2017-01-01T00:00:00','2017-01-20T17:00:00',19*16+16],
            ['2017-01-01T00:00:00','2017-01-20T10:00:00',19*16+10],
        ];
    }


}