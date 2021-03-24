<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Visit;
use App\Models\Ad;
use Illuminate\Http\Request;
use Hillel\Iplookupinterface\IpLookupInterface;
use Hillel\Useragentlookupinterface\UserAgentInterface;

class ShowAds extends Component
{
    use WithPagination;

    public Ad $ad;

    public function render(Request $request, IpLookupInterface $reader, UserAgentInterface $result)
    {

        $reader->ipParse('8.8.8.8'); //$request->ip() vm ip is shit
        $result->userAgentParse($request);

        $new_visit = new Visit();
        $new_visit ->ip             = '8.8.8.8'; //$request->ip()
        $new_visit ->iso_code       = $reader->isoCode();
        $new_visit ->continent_code = $reader->continentCode();
        $new_visit ->browser        = $result->userAgentBrowser();
        $new_visit ->os             = $result->userAgentOs();
        $new_visit ->save();

        return view('livewire.show-ads',
            ['ads' => \App\Models\Ad::paginate(5)]
        );
    }

    public function like()
    {
        $this->ad->addLikeBy(auth()->user());
    }
}
