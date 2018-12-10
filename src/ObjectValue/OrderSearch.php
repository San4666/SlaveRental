<?php

namespace SlaveRental\ObjectValue;


class OrderSearch
{
    /** @var \DateTime */
    public $from;

    /** @var \DateTime */
    public $to;

    /** @var int[] */
    public $slaveIds = [];
}