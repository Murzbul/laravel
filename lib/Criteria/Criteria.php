<?php

namespace Lib\Criteria;

use Illuminate\Http\Request;
use Lib\Criteria\Contracts\Criteria as ICriteria;
use Lib\Criteria\Contracts\Filter;
use Lib\Criteria\Contracts\Sorting;
use Lib\Criteria\Contracts\Pagination as IPagination;
use Lib\Criteria\Pagination;

class Criteria implements ICriteria
{
    public const LIMIT_KEY = 'limit';
    public const LIMIT_DEFAULT = 10;
    public const PAGE_KEY = 'page';
    public const SORT_KEY = 'sort';

    /** @var Request */
    protected $request;
    /** @var Filter */
    private $filter;
    /** @var Sorting */
    private $sorting;

    public function __construct(Request $request, Filter $filter, Sorting $sorting)
    {
        $this->request = $request;
        $this->filter = $filter;
        $this->sorting = $this->buildSorting($sorting);
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getFilter(): Filter
    {
        return $this->filter;
    }

    public function getSorting(): Sorting
    {
        return $this->sorting;
    }

    public function getPagination(): IPagination
    {
        $limit = $this->parseLimit();
        $page = $this->parsePage();

        return new Pagination($limit, $page);
    }

    public function validate(): void
    {
        $this->request->validate([
            static::SORT_KEY => 'sometimes|array',
            static::SORT_KEY . '.*' => 'in:asc,desc,ASC,DESC',
        ]);
    }

    public function getSortingDefaults(): array
    {
        return [];
    }

    protected function getSorts(): array
    {
        return $this->request->input(static::SORT_KEY, []);
    }

    private function buildSorting(Sorting $sorting): Sorting
    {
        $defaults = $this->getSortingDefaults();
        $sorts = $this->getSorts();

        foreach ($defaults as $key => $value) {
            if (!array_key_exists($key, $sorts)) {
                $sorts[$key] =  $value;
            }
        }

        $sorting->set($sorts);

        return $sorting;
    }

    private function parseLimit(): ?int
    {
        $inputLimit = $this->request->input(static::LIMIT_KEY, static::LIMIT_DEFAULT);

        if ($inputLimit !== null && empty($inputLimit)) {
            return null;
        }

        if (is_numeric($inputLimit)) {
            return $inputLimit < 1 ? static::LIMIT_DEFAULT : (int) $inputLimit;
        }

        return static::LIMIT_DEFAULT;
    }

    private function parsePage(): int
    {
        $page = (int) $this->request->input(static::PAGE_KEY, 1);
        if (!is_numeric($page) || empty($page)) {
            return 1;
        }

        return $page;
    }
}
