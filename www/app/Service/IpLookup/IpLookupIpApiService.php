<?php

namespace App\Service\IpLookup;

use Illuminate\Support\Facades\Http;

class IpLookupIpApiService implements IpLookupInterface
{
    public $reader;

    public function ipParse($ip)
    {
        $response = Http::get
            ('http://ip-api.com/json/'.$ip.'?fields=continentCode,countryCode');
        $this->reader = $response->json();
    }

    public function continentCode()
    {
        return $this->reader['continentCode'];
    }

    public function isoCode()
    {
        return $this->reader['countryCode'];
    }
}
