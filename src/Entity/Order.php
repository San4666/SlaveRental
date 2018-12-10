<?php

namespace SlaveRental\Entity;
use DateTime;

class Order
{
    /** @var DateTime */
    private $from;

    /** @var DateTime */
    private $to;

    /** @var integer */
    private $amount;

    /** @var Master */
    private $master;

    /** @var Slave */
    private $slave;

    public function setFrom(DateTime $from): Order
    {
        $this->from = $from;
        return $this;
    }

    public function getFrom(): DateTime
    {
        return $this->from;
    }

    public function setTo(DateTime $to): self
    {
        $this->to = $to;

        return $this;
    }

    public function getTo(): DateTime
    {
        return $this->to;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setMaster(Master $master): self
    {
        $this->master = $master;

        return $this;
    }

    public function getMaster() : Master{
        return $this->master;
    }

    public function setSlave(Slave $slave): self
    {
        $this->slave = $slave;

        return $this;
    }

    public function getSlave(): Slave
    {
        return $this->slave;
    }
}