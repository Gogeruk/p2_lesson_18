<?php

namespace Hillel\Iplookupinterface;

interface IpLookupInterface
{
    public function ipParse($ip);
    public function continentCode();
    public function isoCOde();
}
