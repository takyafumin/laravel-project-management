<?php

namespace Project\Domain\Entities;

use App\Types\ProjectStatus;
use Project\Domain\ValueObjects\AssignTo;
use Project\Domain\ValueObjects\Description;
use Project\Domain\ValueObjects\ProjectId;
use Project\Domain\ValueObjects\Status;
use Project\Domain\ValueObjects\Title;
use Project\Infra\Models\Project as ProjectModel;

/**
 * Project Factory
 */
class ProjectFactory
{
    /**
     * EloquentModelからEntityを生成する
     *
     * @param  \Project\Infra\Models\Project $projectModel Eloquent Model
     * @return Project
     */
    public function eloquent(ProjectModel $projectModel): Project
    {
        return new Project(
            new ProjectId($projectModel->id),
            new Title($projectModel->title),
            new Description($projectModel->description),
            new Status($projectModel->status),
            new AssignTo($projectModel->assign_to)
        );
    }

    /**
     * 新規作成
     *
     * @param array $form 画面入力値
     * @return Project
     */
    public function create(array $form): Project
    {
        return new Project(
            null,
            new Title($form['title']),
            isset($form['description']) ? new Description($form['description']) : null,
            new Status(ProjectStatus::NEW->value),
            isset($form['assign_to']) ? new AssignTo($form['assign_to']) : null
        );
    }
}
