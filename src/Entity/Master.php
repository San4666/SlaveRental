<?php

namespace SlaveRental\Entity;


use phpDocumentor\Reflection\Types\Self_;

class Master
{
    /** @var boolean */
    private $isVip;

    public function setIsVip(bool $isVip): self
    {
        $this->isVip = $isVip;

        return $this;
    }

    public function isVip(): bool
    {
        return $this->isVip;
    }
}