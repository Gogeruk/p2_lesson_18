<?php

namespace App\Service;

use App\Service\ProfileService;
use Illuminate\Support\Facades\Facade;

class ProfileFacade extends Facade
{
     protected static function getFacadeAccessor()
     {
         return 'profileService'; // a unique key of your facade
     }
}
