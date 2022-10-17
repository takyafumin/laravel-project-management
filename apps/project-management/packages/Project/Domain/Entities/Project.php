<?php

namespace Project\Domain\Entities;

use Project\Domain\ValueObjects\AssignTo;
use Project\Domain\ValueObjects\Description;
use Project\Domain\ValueObjects\ProjectId;
use Project\Domain\ValueObjects\Status;
use Project\Domain\ValueObjects\Title;

/**
 * Project Entity
 */
class Project
{
    /**
     * @param ProjectId $id プロジェクトID
     * @param Title $title プロジェクト名
     * @param Description $description プロジェクト詳細
     * @param Status $status プロジェクト状態
     * @param AssignTo $assign_to プロジェクト担当者
     */
    public function __construct(
        private ProjectId $id,
        private Title $title,
        private Description $description,
        private Status $status,
        private AssignTo $assign_to
    ) {
    }

    /**
     * 配列に変換する
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'          => $this->id->value(),
            'title'       => $this->title->value(),
            'description' => $this->description->value(),
            'status'      => $this->status->value(),
            'assign_to'   => $this->assign_to->value(),
        ];
    }
}
