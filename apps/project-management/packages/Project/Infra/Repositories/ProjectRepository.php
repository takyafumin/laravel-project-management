<?php

namespace Project\Infra\Repositories;

use Project\Domain\Entities\Project;
use Project\Domain\Entities\ProjectFactory;
use Project\Domain\Repositories\ProjectRepositoryInterface;
use Project\Domain\ValueObjects\ProjectId;
use Project\Infra\Models\Project as ProjectModel;

/**
 * Project Repository
 */
class ProjectRepository implements ProjectRepositoryInterface
{
    /**
     * @param ProjectModel $projectModel プロジェクト Eloquent Model
     * @param ProjectFactory $factory プロジェクト Factory
     */
    public function __construct(
        private ProjectModel $projectModel,
        private ProjectFactory $factory,
    ) {
    }

    /**
     * リポジトリからデータを取得する
     *
     * @param ProjectId $id プロジェクトID
     * @return Project Project Entity
     */
    public function get(ProjectId $id): Project
    {
        // データ取得
        $model = $this->projectModel->findOrFail($id->value());

        // ドメインモデル返却
        return $this->factory->fromDb($model);
    }
}
