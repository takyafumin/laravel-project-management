<?php

namespace Project\Domain\ValueObjects;

use InvalidArgumentException;

/**
 * プロジェクト名
 */
class Title
{
    /**
     * @param string $title プロジェクト名
     */
    public function __construct(
        private string $title
    ) {
        if (mb_strlen($title) <= 0) {
            throw new InvalidArgumentException("プロジェクト名が不正です, title[{$title}]");
        }

        if (mb_strlen($title) > 50) {
            throw new InvalidArgumentException("プロジェクト名が不正です, title[{$title}]");
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->title;
    }
}
