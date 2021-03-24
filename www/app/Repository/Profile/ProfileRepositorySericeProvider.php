<?php

namespace App\Repository\Profile;

use App\Repository\Profile\ProfileRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ProfileRepositorySericeProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(ProfileRepositoryInterface::class, function () {
            return new DbProfileRepository();
        });
    }
}
