<?php

namespace Hillel\Useragentlookupinterface;

use Illuminate\Http\Request;

interface UserAgentInterface
{
    public function userAgentParse(Request $request);
    public function userAgentBrowser();
    public function userAgentOs();
}
