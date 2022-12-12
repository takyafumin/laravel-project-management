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
     * @param ProjectModel   $projectModel プロジェクトEloquent Model
     * @param ProjectFactory $factory      プロジェクトFactory
     */
    public function __construct(
        private ProjectModel $projectModel,
        private ProjectFactory $factory,
    ) {
    }

    /**
     * リポジトリからデータを取得する
     *
     * @param  ProjectId $id プロジェクトID
     * @return Project Project Entity
     */
    public function get(ProjectId $id): Project
    {
        // データ取得
        $model = $this->projectModel->findOrFail($id->value());

        // ドメインモデル返却
        return $this->factory->eloquent($model);
    }

    /**
     * データを保存する
     *
     * @param  Project $project 登録する情報
     * @return false|Project
     */
    public function save(Project $project): bool|Project
    {
        $model = $this->projectModel->newInstance();
        $model->fill($project->toArray());

        // 保存
        $result = $model->save();
        if (!$result) {
            return false;
        }

        return $this->factory->eloquent($model);
    }
}
