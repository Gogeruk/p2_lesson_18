<?php

namespace App\Service\Useragent;

use Illuminate\Http\Request;
use WhichBrowser\Parser;
use App\Service\Useragent\UserAgentInterface;

class UserAgentTwoService implements UserAgentInterface
{
    public $result;

    public function userAgentParse(Request $request)
    {
        $this->result = new Parser($request->header('User-Agent'));
    }

    public function userAgentBrowser()
    {
        return $this->result->browser->toString();
    }

    public function userAgentOs()
    {
        return $this->result->os->toString();
    }
}
