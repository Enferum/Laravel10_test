<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepo;

class UserService
{
    public function __construct(protected UserRepo $repo)
    {
    }

    public function save(array $request): User
    {
        return $this->repo->save($request);
    }
}
