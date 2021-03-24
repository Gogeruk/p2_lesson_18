<?php

namespace App\Http\Controllers;

use App\Repository\Profile\DbProfileRepository;
use App\Service\ProfileFacade;
use App\Service\ProfileService;

class ProfileController
{

    public function showProfile($user_id)
    {
        return view('pages/profile', ['user' => ProfileFacade::profile($user_id)]);
    }
}
