<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Hillel\Iplookupinterface\IpLookupInterface;


class IPLookupController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ipLookup()
    {
        $ipAdress = '8.8.8.8';  //request()->ip();  //Doesn't work with a vm :(
        return view('pages/ip-lookup', ['ipAdress' => $ipAdress]);
    }
    public function ipLookupProcess(Request $request, IpLookupInterface $reader)
    {
        $request->validate([
            'ipAdress' => ['required', 'ipv4'],
        ]);

        $reader->ipParse($request->ipAdress);

        $ipInfo = [
            'isoCode'       => $reader->isoCode(),
            'continentCode' => $reader->continentCode(),
        ];

        return view('pages/ip-lookup', ['ipAdress' => $request['ipAdress'], 'ipInfo' => $ipInfo]);
    }
}
