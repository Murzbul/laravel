<?php

use Doctrine\ORM\Tools\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Lib\Criteria\Contracts\Criteria;

if (! function_exists('array_convert_nulls_to_empty')) {
    /**
     * Convert the null values of an array to empty strings recursively.
     */
    function array_convert_nulls_to_empty(array $data = []): array
    {
        return array_map(function ($item) {
            if (is_array($item)) {
                return array_convert_nulls_to_empty($item);
            }

            return $item === null ? '' : $item;
        }, $data);
    }
}

if (! function_exists('adapt_paginator')) {
    /**
     * Generate paginator compatible with Fractal.
     */
    function adapt_paginator(Paginator $paginator, Criteria $request): IlluminatePaginatorAdapter
    {
        $options = [
            'path' => $request->getRequest()->url(),
            'query' => $request->getRequest()->query(),
        ];

        $limit = $request->getPagination()->getLimit();

        $paginator
            ->getQuery()
            ->setMaxResults($limit)
            ->setFirstResult(($request->getPagination()->getPage() - 1) * $limit);

        return new IlluminatePaginatorAdapter(
            new LengthAwarePaginator(
                $paginator,
                $paginator->count(),
                $limit,
                $request->getPagination()->getPage(),
                $options
            )
        );
    }
}
