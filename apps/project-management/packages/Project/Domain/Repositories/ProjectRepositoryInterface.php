<?php

namespace Project\Domain\Repositories;

use Project\Domain\Entities\Project;
use Project\Domain\ValueObjects\ProjectId;

/**
 * Project Repository Interface
 */
interface ProjectRepositoryInterface
{
    /**
     * リポジトリからデータを取得する
     *
     * @param  ProjectId $id プロジェクトID
     * @param  bool $lock データロックするか
     * @return Project
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findById(ProjectId $id, bool $lock = false): Project;

    /**
     * データを保存する
     *
     * @param  Project $project 登録する情報
     * @return false|Project
     */
    public function save(Project $project): bool|Project;
}
