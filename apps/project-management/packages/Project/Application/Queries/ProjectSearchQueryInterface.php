<?php

namespace Project\Application\Queries;

use Illuminate\Support\Collection;
use Project\Domain\ValueObjects\ProjectId;

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

    /**
     * 詳細データ取得
     *
     * @param ProjectId $id プロジェクトID
     * @return array
     */
    public function find(ProjectId $id): array;
}
