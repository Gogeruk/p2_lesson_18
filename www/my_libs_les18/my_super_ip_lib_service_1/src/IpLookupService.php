<?php

namespace Hillel\Iplookupservice1;

use GeoIp2\Database\Reader;
use Hillel\Iplookupinterface\IpLookupInterface;

class IpLookupService implements IpLookupInterface
{
    public $reader;
    public $ipInitialized;

    public function __construct()
    {
        $this->reader = new Reader(base_path().'/database/geoLite2/GeoLite2-Country.mmdb');
    }

    public function ipParse($ip)
    {
        $this->ipInitialized = $this->reader->country($ip);
    }

    public function continentCode()
    {
        return $this->ipInitialized->continent->code;
    }

    public function isoCode()
    {
        return $this->ipInitialized->country->isoCode;
    }
}
