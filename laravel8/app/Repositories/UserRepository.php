<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends ResourceRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    private function save(User $user, array $inputs)
    {
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->password = $inputs['password'];
        $user->admin = isset($inputs['admin']);

        $user->save();
    }

}