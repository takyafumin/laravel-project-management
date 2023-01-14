<?php

namespace Project\Presentation\Responses;

use Illuminate\Support\Collection;

/**
 * Project Edit Response
 */
class ProjectEditResponse
{
    /**
     * @param Collection $user_list        担当者一覧
     * @param array $project プロジェクト情報配列
     */
    public function __construct(
        public Collection $user_list,
        public array $project,
    ) {
    }
}
