<?php

namespace App\Repositories;

use App\Models\User;

class UserRepo
{
    public function __construct(protected User $user)
    {
    }

    public function save(array $request): User
    {
        $request['phone'] = $this->user->formatPhone($request['phone']);
        return $this->user->create($request);
    }
}
