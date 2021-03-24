<?php

namespace App\Repository\Profile;

use Illuminate\Support\ServiceProvider;
use App\Service\IpLookup\IpLookupInterface;

class ProfileFacadeSericeProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton('profileService', function ($app) {
            return new DbProfileRepository(
                $app->make(ProfileRepositoryInterface::class)
            );
        });
    }
}
