<?php

namespace Project\Domain\Entities;

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
     * @param \Project\Infra\Models\Project $projectModel Eloquent Model
     * @return Project
     */
    public function fromDb(ProjectModel $projectModel): Project
    {
        return new Project(
            new ProjectId($projectModel->id),
            new Title($projectModel->title),
            new Description($projectModel->description),
            new Status($projectModel->status),
            new AssignTo($projectModel->assign_to)
        );
    }
}
