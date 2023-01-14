<?php

namespace Project\Domain\Entities;

use Project\Domain\ValueObjects\AssignTo;
use Project\Domain\ValueObjects\Description;
use Project\Domain\ValueObjects\ProjectId;
use Project\Domain\ValueObjects\Status;
use Project\Domain\ValueObjects\Title;

/**
 * Project Entity
 *
 * @property ProjectId $id
 * @property Title $title
 * @property Description $description
 * @property Status $status
 * @property AssignTo $assign_to
 */
class Project
{
    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }
    }

    /**
     * @param ProjectId|null   $id          プロジェクトID
     * @param Title            $title       プロジェクト名
     * @param Description|null $description プロジェクト詳細
     * @param Status           $status      プロジェクト状態
     * @param AssignTo|null    $assign_to   プロジェクト担当者
     */
    public function __construct(
        private ?ProjectId $id,
        private Title $title,
        private ?Description $description,
        private Status $status,
        private ?AssignTo $assign_to
    ) {
    }

    /**
     * 属性情報を変更する
     *
     * @param Title            $title       プロジェクト名
     * @param Description|null $description プロジェクト詳細
     * @return void
     */
    public function editAttributes(
        Title $title,
        ?Description $description,
    ): void {
        $this->title       = $title;
        $this->description = $description;
    }

    /**
     * 担当者を設定する
     *
     * @param AssignTo $assign_to 担当者
     * @return void
     */
    public function assignTo(AssignTo $assign_to): void
    {
        $this->assign_to = $assign_to;
    }

    /**
     * 配列に変換する
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title'       => $this->title->value(),
            'description' => $this->description?->value(),
            'status'      => $this->status->value()->value,
            'assign_to'   => $this->assign_to?->value(),
        ];
    }
}
