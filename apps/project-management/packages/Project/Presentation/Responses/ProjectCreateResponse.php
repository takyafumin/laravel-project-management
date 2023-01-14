<?php

namespace Project\Presentation\Responses;

use Illuminate\Support\Collection;

/**
 * Project Create Response
 */
class ProjectCreateResponse
{
    /**
     * @param Collection $user_list        担当者一覧
     */
    public function __construct(
        public Collection $user_list
    ) {
    }
}
