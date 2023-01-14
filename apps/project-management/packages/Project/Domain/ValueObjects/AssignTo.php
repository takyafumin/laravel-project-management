<?php

namespace Project\Domain\ValueObjects;

/**
 * プロジェクト担当者
 */
class AssignTo
{
    /**
     * @param integer|null $user_id ユーザID
     */
    public function __construct(
        private ?int $user_id
    ) {
    }

    /**
     * @return integer|null
     */
    public function value(): ?int
    {
        return $this->user_id;
    }
}
