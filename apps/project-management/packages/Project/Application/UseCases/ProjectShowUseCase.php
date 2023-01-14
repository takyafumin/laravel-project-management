<?php

namespace Project\Application\UseCases;

use Project\Application\Queries\ProjectSearchQueryInterface;
use Project\Domain\ValueObjects\ProjectId;

/**
 * 詳細データ表示 UseCase
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
