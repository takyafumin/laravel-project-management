<?php

namespace Project\Application\UseCases;

use Illuminate\Support\Collection;
use Support\Application\Queries\UserListQueryInterface;

/**
 * 登録画面表示 UseCase
 */
class ProjectCreateUseCase
{
    /**
     * @param UserListQueryInterface $user_list_query
     */
    public function __construct(
        private UserListQueryInterface $user_list_query
    ) {
    }


    /**
     * 登録画面表示処理
     *
     * @return Collection
     */
    public function invoke(): Collection
    {
        return $this->user_list_query->list();
    }
}
