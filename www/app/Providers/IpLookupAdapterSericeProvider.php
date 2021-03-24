<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Hillel\Iplookupservice1\IpLookupService;
use Hillel\Iplookupservice2\IpLookupIpApiService;
use Hillel\Iplookupinterface\IpLookupInterface;

class IpLookupAdapterSericeProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(IpLookupInterface::class, function () {
            //return new IpLookupService();
            return new IpLookupIpApiService();
        });
    }
}
