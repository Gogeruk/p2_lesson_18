<?php

namespace App\Providers;

use Hillel\Useragentlookupinterface\UserAgentInterface;
use Hillel\Useragentlookupservice1\UserAgentService;
use Hillel\Useragentlookupservice2\UserAgentTwoService;
use Illuminate\Support\ServiceProvider;

class UserAgentAdapterSericeProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(UserAgentInterface::class, function () {
            return new UserAgentService();
            //return new UserAgentTwoService();
        });
    }
}
