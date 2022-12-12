<?php

namespace Project\Application\Queries;

use Illuminate\Support\Collection;

/**
 * User Search QueryInterface
 */
interface UserSearchQueryInterface
{
    /**
     * ユーザ一覧を返却する
     *
     * @return Collection
     */
    public function list(): Collection;
}
