<?php

namespace Hillel\Iplookupservice2;

use Illuminate\Support\Facades\Http;
use Hillel\Iplookupinterface\IpLookupInterface;

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
