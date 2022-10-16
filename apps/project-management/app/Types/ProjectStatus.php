<?php

namespace App\Types;

/**
 * Project Status
 */
enum ProjectStatus: int
{
    case NEW     = 0;
    case WIP     = 1;
    case DONE    = 2;
    case PENDING = 3;
    case CLOSE   = 9;

    /**
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::NEW     => '未着手',
            self::WIP     => '作業中',
            self::DONE    => '対応済',
            self::PENDING => '保留',
            self::CLOSE   => '完了',
        };
    }
}
