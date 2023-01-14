<?php

namespace Project\Presentation\Responses;

use App\Supports\PaginatorInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Project Search Response
 *
 * @property LengthAwarePaginator $paginator Paginator
 */
class ProjectSearchResponse implements PaginatorInterface
{
    /**
     * @param array $condition 検索条件
     * @param integer $page_number ページ番号
     * @param Collection $list 検索結果一覧
     * @param integer $total_count 総件数
     * @param string $path リンクパス
     */
    public function __construct(
        public array $condition,
        public int $page_number,
        public Collection $list,
        int $total_count,
        string $path,
    ) {

        // Paginator
        $this->paginator = new LengthAwarePaginator(
            $list,
            $total_count,
            self::PER_PAGE,
            $page_number,
            ['path' => $path]
        );
    }
}
