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
     * @param ProjectId $id プロジェクトID
     * @return Project
     */
    public function get(ProjectId $id): Project;
}
