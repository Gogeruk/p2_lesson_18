<?php

namespace App\Service\IpLookup;

interface IpLookupInterface
{
    public function ipParse($ip);
    public function continentCode();
    public function isoCOde();
}
