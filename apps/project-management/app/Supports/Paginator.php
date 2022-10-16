<?php

namespace App\Supports;

/**
 * Paginator Trait
 */
trait Paginator
{
    /**
     * Offsetを返却する
     *
     * @param integer $page_number ページ番号
     * @param integer $per_page 1ページあたりの件数
     * @return int
     */
    private function getOffset(int $page_number, int $per_page): int
    {
        return ($page_number - 1) * $per_page;
    }
}
