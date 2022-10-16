<?php

namespace Project\Presentation\Responses;

use Illuminate\Support\Collection;

/**
 * Project Search Response
 */
class ProjectSearchResponse
{
    /**
     * @param array $condition 検索条件
     * @param integer $page_number ページ番号
     * @param Collection $list 検索結果一覧
     */
    public function __construct(
        public array $condition,
        public int $page_number,
        public Collection $list
    ) {
    }
}
