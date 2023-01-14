<?php

namespace App\Types;

use RuntimeException;

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

    /**
     * ENUM値を生成する
     *
     * @param integer $code コード値
     * @return ProjectStatus
     */
    public static function create(int $code): ProjectStatus
    {
        return match ($code) {
            self::NEW->value     => self::NEW,
            self::WIP->value     => self::WIP,
            self::DONE->value    => self::DONE,
            self::PENDING->value => self::PENDING,
            self::CLOSE->value   => self::CLOSE,
            default => throw new RuntimeException("定義値がありません, code[{$code}]"),
        };
    }
    public static function iconStyle(int $code): string
    {
        return match ($code) {
            self::NEW->value     => 'bg-blue-200 text-blue-600',
            self::WIP->value     => 'bg-yellow-200 text-yellow-600',
            self::DONE->value    => 'bg-green-200 text-green-600 ',
            self::PENDING->value => 'bg-red-200 text-red-600',
            self::CLOSE->value   => 'bg-gray-300 text-gray-600',
            default => throw new RuntimeException("定義値がありません, code[{$code}]"),
        };
    }
}
