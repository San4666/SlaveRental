<?php

namespace SlaveRental\Entity;


class Slave
{
    /** @var int */
    private $id;

    /** @var int */
    private $rate;

    /** @var \DateTime */
    private $birthday;

    /** @var Country */
    private $country;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setRate(int $rate): self {
        $this->rate = $rate;

        return $this;
    }

    public function getRate(): int {
        return $this->rate;
    }

    public function getBirthday(): \DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTime $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function setCountry(Country $country): self
    {
        $this->country = $country;

        return $this;
    }



}