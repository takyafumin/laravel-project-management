<?php

namespace Project\Application\UseCases;

use Project\Application\Queries\ProjectSearchQueryInterface;
use Project\Domain\Entities\Project;
use Project\Domain\ValueObjects\ProjectId;
use Project\Infra\Queries\ProjectSearchQuery;

/**
 * Project Show UseCase
 */
class ProjectShowUseCase
{
    /**
     * @param ProjectSearchQueryInterface $query プロジェクト検索クエリ
     */
    public function __construct(
        private ProjectSearchQueryInterface $query
    ) {
    }

    /**
     * 詳細データ取得
     *
     * @param int $id プロジェクトID
     * @return array プロジェクト情報配列
     */
    public function invoke(int $id): array
    {
        return $this->query->find(new ProjectId($id));
    }
}
