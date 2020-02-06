<?php

namespace App\Infrastructure\Doctrine\Repositories;

use App\Infrastructure\Doctrine\Criteria\Users\UserFilter;
use Digichange\Entities\User;
use Digichange\Repositories\UserRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Lib\Criteria\Contracts\Criteria;

class DoctrineUserRepository extends DoctrineReadRepository implements UserRepository
{
    public function getEntity()
    {
        return User::class;
    }

    public function search(Criteria $criteria): Paginator
    {
        // TODO: Install packages to lower and unnacent on postgresql
        $filter = $criteria->getFilter();
        $sorting = $criteria->getSorting();

        $itemAlias = 'user';

        $queryBuilder = $this->createQueryBuilder($itemAlias);

        // TODO: Encapsulate this funcionality in a builder of query SEARCH
        if ($filter->has(UserFilter::SEARCH) && ! empty($filter->get(UserFilter::SEARCH))) {
            $search = [];
            $term = str_replace(' ', '%', $filter->get(UserFilter::SEARCH));

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
