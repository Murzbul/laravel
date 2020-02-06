<?php

namespace App\Infrastructure\Doctrine\Repositories;

use App\Infrastructure\Doctrine\Criteria\Roles\RoleFilter;
use Digichange\Entities\Role;
use Digichange\Repositories\RoleRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Lib\Criteria\Contracts\Criteria;

class DoctrineRoleRepository extends DoctrineReadRepository implements RoleRepository
{
    public function getEntity()
    {
        return Role::class;
    }

    public function search(Criteria $criteria): Paginator
    {
        // TODO: Install packages to lower and unnacent on postgresql
        $filter = $criteria->getFilter();
        $sorting = $criteria->getSorting();

        $itemAlias = 'role';

        $queryBuilder = $this->createQueryBuilder($itemAlias);

        // TODO: Encapsulate this funcionality in a builder of query SEARCH
        if ($filter->has(RoleFilter::SEARCH) && ! empty($filter->get(RoleFilter::SEARCH))) {
            $search = [];
            $term = str_replace(' ', '%', $filter->get(RoleFilter::SEARCH));

            foreach ($filter->getFields() as $fieldSearch) {
                $search[] = "LOWER({$itemAlias}.{$fieldSearch}) LIKE LOWER(:searchTerm)";
            }

            $queryBuilder->andWhere($queryBuilder->expr()->orX(...$search));
            $queryBuilder->setParameter('searchTerm', "%{$term}%");
        }

        // TODO: Encapsulate this funcionality in a builder of query SORT
        foreach ($sorting->getRaw() as $sortBy => $sortSense) {
            $queryBuilder->addOrderBy("$itemAlias.$sortBy", $sortSense);
        }

        return new Paginator($queryBuilder);
    }
}
