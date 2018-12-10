<?php

namespace SlaveRental\Service;


use SlaveRental\Entity\Category;
use SlaveRental\Entity\Slave;
use SlaveRental\Repository\ISlaveCategoryRepository;

class SlaveCategoryCreator
{
    /**
     * @var ISlaveCategoryRepository
     */
    private $repository;

    public function __construct(ISlaveCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(Slave $slave, Category $category)
    {
        if (!$this->repository->exist($slave, $category)) {
            if ($category->getParent() != null) {
                $this->create($slave, $category);
            }
            $this->repository->create($slave, $category);
        }
    }
}