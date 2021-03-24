<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ad;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class AdController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function create()
    {
        return view('ad/form_ad', ['editing' => 'not_editing']);
    }

    public function createSave(Request $request)
    {
        $request->validate([
            'title'       => ['required', 'unique:ads,title', 'min:5', 'max:255', 'string'],
            'description' => ['required', 'min:5', 'max:255', 'string'],
        ]);

        $new_ad = new Ad();
        $new_ad ->title       = $request['title'];
        $new_ad ->description = $request['description'];
        $new_ad ->user_id     = $request['user_id'];
        $new_ad ->save();

        $id = Ad::where('title', $request['title'])->first()->id;
        return redirect()->route('show_an_ad_by_id', $id)
            ->with('status', "An ad \"{$request['title']}\" has been created");
    }

    public function update($id)
    {
        $ad = Ad::find($id);

        $this->authorize('update', $ad);

        return view('ad/form_ad', ['ad' => $ad, 'editing' => 'editing']);
    }

    public function updateSave($id)
    {
        $data  = request();
        $up_ad = Ad::find($id);
        $this->authorize('update', $up_ad);

        $data->validate([
            'title'       => ['required', 'unique:ads,title', 'min:5', 'max:255', 'string'],
            'description' => ['required', 'min:5', 'max:255', 'string'],
        ]);

        $up_ad ->title       = $data['title'];
        $up_ad ->description = $data['description'];
        $up_ad ->user_id     = $data['user_id'];
        $up_ad ->save();

        return redirect()->route('home')
            ->with('status', "An ad \"{$data['title']}\" has been updated");
    }

    public function delete($id)
    {
        $ad = Ad::find($id);

        $this->authorize('delete', $ad);
        $ad->delete();

        return redirect()->route('home')
            ->with('status', 'An ad has been deleted');
    }

    public function show($id)
    {
        if (Ad::where('id', '=', $id)->exists()) {
            $ad = Ad::find($id);
            return view('pages/id-display', ['ad' => $ad]);
        }
        return redirect()->route('home');
    }
}
