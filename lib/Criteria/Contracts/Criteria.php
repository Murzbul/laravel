<?php

namespace Lib\Criteria\Contracts;

use Illuminate\Http\Request;

interface Criteria
{
    public function getFilter(): Filter;

    public function getSorting(): Sorting;

    public function getSortingDefaults(): array;

    public function getPaginationData();
}
