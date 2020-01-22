<?php

namespace App\Infrastructure\Doctrine\Repositories;

use App\Infrastructure\Doctrine\Criteria\Items\ItemFilter;
use Digichange\Entities\Item;
use Digichange\Repositories\ItemRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Lib\Criteria\Contracts\Criteria;

class DoctrineItemRepository extends DoctrineReadRepository implements ItemRepository
{
    public function getEntity()
    {
        return Item::class;
    }

    public function search(Criteria $criteria): Paginator
    {
        // TODO: Install packages to lower and unnacent on postgresql
        $filter = $criteria->getFilter();
        $sorting = $criteria->getSorting();

        $itemAlias = 'item';

        $queryBuilder = $this->createQueryBuilder($itemAlias);

        // TODO: Encapsulate this funcionality in a builder of query SEARCH
        if ($filter->has(ItemFilter::SEARCH) && ! empty($filter->get(ItemFilter::SEARCH))) {
            $search = [];
            $term = str_replace(' ', '%', $filter->get(ItemFilter::SEARCH));

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
