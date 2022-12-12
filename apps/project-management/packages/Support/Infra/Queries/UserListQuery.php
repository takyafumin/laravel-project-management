<?php

namespace Support\Infra\Queries;

use App\Models\User;
use Illuminate\Support\Collection;
use Support\Application\Queries\UserListQueryInterface;

/**
 * User List Query
 */
class UserListQuery implements UserListQueryInterface
{
    public function list(): Collection
    {
        return User::query()
            ->whereNull('deleted_at')
            ->orderBy('name')
            ->orderBy('id')
            ->get();
    }
}
