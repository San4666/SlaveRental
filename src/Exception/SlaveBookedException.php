<?php

namespace SlaveRental\Exception;


use Throwable;

class SlaveBookedException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}