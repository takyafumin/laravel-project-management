<?php

namespace Project\Application\UseCases;

use Illuminate\Support\Collection;
use Project\Application\Queries\ProjectSearchQueryInterface;

/**
 * Project Search UseCase
 */
class ProjectSearchUseCase
{
    /**
     * @param ProjectSearchQueryInterface $query 検索クエリ
     */
    public function __construct(
        private ProjectSearchQueryInterface $query
    ) {
    }

    /**
     * 検索
     *
     * @return Collection
     */
    public function invoke(array $condition, int $page_number): Collection
    {
        return $this->query->search($condition, $page_number);
    }
}
