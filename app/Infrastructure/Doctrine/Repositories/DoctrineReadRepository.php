<?php

namespace App\Infrastructure\Doctrine\Repositories;

use Digichange\Repositories\ReadRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineReadRepository extends EntityRepository implements ReadRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata($this->getEntity()));
    }

    abstract public function getEntity();

    public function get($id)
    {
        $entity = $this->findOne($id);

        if (! $entity) {
            throw new EntityNotFoundException($this->getEntity());
        }

        return $entity;
    }

    public function findOne($id)
    {
        return $this->find($id);
    }

    public function all()
    {
        return $this->findAll();
    }

    public function refresh($entity)
    {
        $this->_em->refresh($entity);
    }
}
