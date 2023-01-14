<?php

namespace Project\Infra\Repositories;

use Project\Domain\Entities\Project;
use Project\Domain\Entities\ProjectFactory;
use Project\Domain\Repositories\ProjectRepositoryInterface;
use Project\Domain\ValueObjects\ProjectId;
use Project\Infra\Models\Project as ProjectEloquentModel;

/**
 * Project Repository
 */
class ProjectRepository implements ProjectRepositoryInterface
{
    /**
     * @param ProjectEloquentModel   $projectModel プロジェクトEloquent Model
     * @param ProjectFactory $factory      プロジェクトFactory
     */
    public function __construct(
        private ProjectEloquentModel $projectModel,
        private ProjectFactory $factory,
    ) {
    }

    /**
     * リポジトリからデータを取得する
     *
     * @param  ProjectId $id プロジェクトID
     * @param  bool $lock データロックするか
     * @return Project Project Entity
     */
    public function findById(ProjectId $id, bool $lock = false): Project
    {
        // データ取得
        // TODO ロック処理を実装
        $model = $this->projectModel->findOrFail($id->value());

        // ドメインモデル返却
        return $this->factory->eloquent($model);
    }

    /**
     * データを保存する
     *
     * @param  Project $entity 永続化するEntity
     * @return false|Project
     */
    public function save(Project $entity): bool|Project
    {
        $eloquent = $this->createEloquentModel($entity->id);
        $eloquent->fill($entity->toArray());

        // 保存
        if (!$eloquent->save()) {
            return false;
        }

        return $this->factory->eloquent($eloquent);
    }

    /**
     * EloquentModelを生成する
     *
     * @param ProjectId|null $project_id ID
     * @return ProjectEloquentModel
     */
    private function createEloquentModel(?ProjectId $project_id): ProjectEloquentModel
    {
        if (is_null($project_id)) {
            return $this->projectModel->newInstance();
        }

        return $this->projectModel->findOrFail($project_id->value());
    }
}
