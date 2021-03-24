<?php

namespace App\Repository\Profile;

use App\Models\User;
use App\Repository\Profile\ProfileRepositoryInterface;

class DbProfileRepository implements ProfileRepositoryInterface
{

    public function profile($user_id)
    {
        return User::find($user_id);
    }

}
