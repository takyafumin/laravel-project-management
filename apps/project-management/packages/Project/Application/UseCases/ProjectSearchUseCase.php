<?php

namespace Project\Application\UseCases;

use Project\Application\Queries\ProjectSearchQueryInterface;

/**
 * 検索 UseCase
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
     * 検索処理
     *
     * @param array $condition 検索条件配列
     * @param integer $page_number ページ番号
     * @param integer $per_page ページあたり件数
     *
     * @return array{\Illuminate\Support\Collection, int} 検索結果
     *  - 一覧
     *  - 総件数
     */
    public function invoke(array $condition, int $page_number, int $per_page): array
    {
        // 一覧取得
        $list = $this->query->search($condition, $page_number, $per_page);

        // 総件数取得
        $count = $this->query->count($condition);

        return [$list, $count];
    }
}
