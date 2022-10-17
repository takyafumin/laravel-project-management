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
     * @param array $condition 検索条件配列
     * @param integer $page_number ページ番号
     * @param integer $per_page ページあたり件数
     *
     * @return array{\Illuminate\Support\Collection, int}
     */
    public function invoke(array $condition, int $page_number, int $per_page): array
    {
        $list = $this->query->search($condition, $page_number, $per_page);
        $count = $this->query->count($condition);

        return [$list, $count];
    }
}
