<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Hillel\Useragentlookupinterface\UserAgentInterface;

class UserAgentController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function useragent(Request $request, UserAgentInterface $result)
    {
        $result->userAgentParse($request);

        $useragent = [
            'browser' => $result->userAgentBrowser(),
            'os'      => $result->userAgentOs(),
        ];

        return view('pages/useragent', ['useragent' => $useragent]);
    }
}
