<?php

namespace Project\Application\Queries;

use App\Supports\Paginator;
use Illuminate\Support\Collection;

/**
 * Project Search QueryInterface
 */
interface ProjectSearchQueryInterface
{
    public const PER_PAGE = 10;

    /**
     * 検索
     *
     * @param array $condition 検索条件
     * @param integer $page_number ページ番号
     * @param integer $per_page 1ページあたりの表示件数
     * @return Collection
     */
    public function search(array $condition, $page_number = 1, $per_page = self::PER_PAGE): Collection;
}
