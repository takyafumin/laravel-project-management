<?php

namespace Project\Application\UseCases;

use Project\Application\Queries\ProjectSearchQueryInterface;
use Project\Domain\ValueObjects\ProjectId;
use Support\Application\Queries\UserListQueryInterface;

/**
 * 更新画面表示 UseCase
 */
class ProjectEditUseCase
{
    /**
     * @param ProjectSearchQueryInterface $query プロジェクト検索クエリ
     */
    public function __construct(
        private UserListQueryInterface $user_list_query,
        private ProjectSearchQueryInterface $query,
    ) {
    }

    /**
     * 更新画面表示処理
     *
     * @param int $id ID
     * @return array{0:\Illuminate\Support\Collection, 1:array} [ユーザリスト, プロジェクト情報配列]
     */
    public function invoke(int $id): array
    {
        return [
            $this->user_list_query->list(),
            $this->query->find(new ProjectId($id))
        ];
    }
}
