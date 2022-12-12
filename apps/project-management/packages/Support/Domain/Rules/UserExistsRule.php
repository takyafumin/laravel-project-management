<?php

namespace Support\Domain\Rules;

use Support\Application\Queries\UserListQueryInterface;
use Support\Domain\Exceptions\DomainRuleException;

/**
 * UserExistsRule
 */
class UserExistsRule
{
    /**
     * @param UserListQueryInterface $user_list_query
     */
    public function __construct(
        private UserListQueryInterface $user_list_query
    ) {
    }

    /**
     * validate
     *
     * @param integer $id ユーザID
     * @return void
     */
    public function validate(int $id): void
    {
        $user_id_list = $this->user_list_query->list()
            ->map(function ($item) {
                return $item->id;
            });

        if (false === $user_id_list->has($id)) {
            throw new DomainRuleException('存在しないユーザが指定されました');
        };
    }
}
