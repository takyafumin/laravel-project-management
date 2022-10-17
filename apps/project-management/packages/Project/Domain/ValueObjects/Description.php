<?php

namespace Project\Domain\ValueObjects;

use InvalidArgumentException;

/**
 * プロジェクト詳細
 */
class Description
{
    /**
     * @param string $description プロジェクト詳細
     */
    public function __construct(
        private string $description
    ) {
        if (mb_strlen($description) > 255) {
            throw new InvalidArgumentException("プロジェクト詳細が不正です, description[{$description}]");
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->description;
    }
}
