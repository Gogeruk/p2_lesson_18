<?php

namespace Hillel\Useragentlookupservice1;

use Illuminate\Http\Request;
use UAParser\Parser;
use Hillel\Useragentlookupinterface\UserAgentInterface;

class UserAgentService implements UserAgentInterface
{
    public $result;

    public function userAgentParse(Request $request)
    {
        $this->result = Parser::create()
            ->parse($request->header('User-Agent'));
    }

    public function userAgentBrowser()
    {
        return $this->result->ua->family;
    }

    public function userAgentOs()
    {
        return $this->result->os->family;
    }
}
