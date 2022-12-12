<?php

namespace Support\Application\Queries;

use Illuminate\Support\Collection;

/**
 * User List QueryInterface
 */
interface UserListQueryInterface
{
    /**
     * ユーザ一覧を返却する
     *
     * @return Collection
     */
    public function list(): Collection;
}
