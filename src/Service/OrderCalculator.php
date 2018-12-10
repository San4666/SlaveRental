<?php
namespace SlaveRental\Service;

use SlaveRental\Entity\Order;
use DateTime;

class OrderCalculator
{
    const MAX_HOURS_WORK = 16;

    public function calculate(Order $order)
    {
        $workHours = $this->calculateWorkHours($order);
        $order->setAmount($workHours * $order->getSlave()->getRate());

        return $workHours * $order->getSlave()->getRate();
    }

    public function calculateWorkHours(Order $order): int
    {
        return $this->isInsideDay($order)
            ? $this->getWorkHoursInsideDay($order)
            : $this->getWorkHours($order);
    }

    private function getWorkHours(Order $order) {
        $from = $order->getFrom();
        $to = $order->getTo();
        $beginNextday = $this->getFrom($order)->modify("+1 day")->setTime(0,0,0);
        $diff =  $beginNextday->diff($to);

        $result = $diff->days*self::MAX_HOURS_WORK;
        $result +=  min($diff->h,self::MAX_HOURS_WORK);
        $result += min(23 - (int)$from->format("H"),self::MAX_HOURS_WORK);

        return  $result;
    }

    private function getTo(Order $order): DateTime
    {
        $to = clone $order->getTo();
        if ((int)$to->format('M') != 0 || (int)$to->format('s') != 0) {
            $to->modify('+1 hour');
            $to->setTime((int)$to->format('H'), 0, 0);
        }

        return $to;
    }

    private function getFrom(Order $order)
    {
        $from = clone $order->getFrom();
        $from->setTime((int)$from->format('H'), 0, 0);

        return $from;
    }

    private function getWorkHoursInsideDay(Order $order): int
    {
        return min($this->getFrom($order)->diff($this->getTo($order))->h,self::MAX_HOURS_WORK);
    }

    private function isInsideDay(Order $order): bool
    {
        return $this->getFrom($order)->format('d-m-Y') === $order->getTo($order)->format('d-m-Y');
    }


}