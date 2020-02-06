<?php

namespace Digichange\Repositories;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityNotFoundException;

interface ReadRepository extends ObjectRepository
{
    /**
     * @throws EntityNotFoundException
     *
     * @return object
     */
    public function get(int $id);

    public function getOneBy(array $criteria, array $orderBy = null);

    /**
     * @throws EntityNotFoundException
     *
     * @return object|null
     */
    public function findOne(int $id);

    public function all();

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    public function findOneBy(array $criteria);

    public function refresh($entity);
}
