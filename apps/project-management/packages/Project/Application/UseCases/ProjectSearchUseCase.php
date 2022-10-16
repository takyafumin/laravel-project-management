<?php

namespace Project\Application\UseCases;

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
     * @return array{\Illuminate\Support\Collection, int}
     */
    public function invoke(array $condition, int $page_number): array
    {
        $list = $this->query->search($condition, $page_number);
        $count = $this->query->count($condition);

        return [$list, $count];
    }
}
