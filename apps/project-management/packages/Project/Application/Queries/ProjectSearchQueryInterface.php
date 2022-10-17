<?php

namespace Project\Application\Queries;

use App\Supports\Paginator;
use Illuminate\Support\Collection;

/**
 * Project Search QueryInterface
 */
interface ProjectSearchQueryInterface
{
    /**
     * 検索
     *
     * @param array $condition 検索条件
     * @param integer $page_number ページ番号
     * @param integer $per_page ページあたりの表示件数
     * @return Collection
     */
    public function search(array $condition, int $page_number, int $per_page): Collection;

    /**
     * 件数取得
     *
     * @param array $condition 検索条件
     * @return integer
     */
    public function count(array $condition): int;
}
