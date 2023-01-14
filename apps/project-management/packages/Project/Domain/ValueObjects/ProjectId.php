<?php

namespace Project\Domain\ValueObjects;

use InvalidArgumentException;

/**
 * プロジェクトID
 */
class ProjectId
{
    /**
     * @param integer $id プロジェクトID
     */
    public function __construct(
        private int $id
    ) {
        if (0 >= $id) {
            throw new InvalidArgumentException("プロジェクトIDが不正です, id[{$id}]");
        }
    }

    /**
     * @return integer プロジェクトID
     */
    public function value(): int
    {
        return $this->id;
    }
}
