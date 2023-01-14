<?php

namespace Project\Domain\ValueObjects;

use App\Types\ProjectStatus;

/**
 * プロジェクト状態
 *
 * @property ProjectStatus $status プロジェクト状態
 */
class Status
{
    /**
     * @param int $status プロジェクト状態
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function __construct(
        int $status
    ) {
        $this->status = ProjectStatus::create($status);
    }

    /**
     * @return ProjectStatus
     */
    public function value(): ProjectStatus
    {
        return $this->status;
    }
}
