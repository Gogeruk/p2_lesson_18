<?php

namespace App\Service\Useragent;

use Illuminate\Http\Request;

interface UserAgentInterface
{
    public function userAgentParse(Request $request);
    public function userAgentBrowser();
    public function userAgentOs();
}
