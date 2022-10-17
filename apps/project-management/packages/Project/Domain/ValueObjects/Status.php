<?php

namespace Project\Domain\ValueObjects;

use App\Types\ProjectStatus as TypesProjectStatus;

/**
 * プロジェクト状態
 *
 * @property TypesProjectStatus $status プロジェクト状態
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
        $this->status = TypesProjectStatus::create($status);
    }

    /**
     * @return TypesProjectStatus
     */
    public function value(): TypesProjectStatus
    {
        return $this->status;
    }
}
