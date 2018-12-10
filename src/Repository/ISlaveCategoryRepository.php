<?php

namespace SlaveRental\Repository;


use SlaveRental\Entity\Category;
use SlaveRental\Entity\Slave;

interface ISlaveCategoryRepository
{
    function exist(Slave $slave, Category $category) : bool;

    function create(Slave $slave, Category $category): void;

    function delete(Slave $slave, Category $category): void;
}