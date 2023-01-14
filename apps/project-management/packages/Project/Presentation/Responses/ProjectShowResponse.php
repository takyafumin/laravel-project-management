<?php

namespace Project\Presentation\Responses;

/**
 * Project Show Response
 */
class ProjectShowResponse
{
    /**
     * @param array $project プロジェクト情報配列
     */
    public function __construct(
        public array $project,
    ) {
    }
}
