<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\VoteForYourCity;
use Illuminate\Http\Request;

class VoteForYourCityController extends Controller
{
    public function index()
    {

        $data =  VoteForYourCity::get();
        return view('backend.service_menu.vote_for_your_city.index', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);

        $savedata = new VoteForYourCity();
        $savedata->description = $request->description;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/vote_for_your_city')->with('success', 'Data save Successful.');
    }
    public function update($id)
    {
        $item = VoteForYourCity::where('id', $id)->first();
        return view('backend.service_menu.vote_for_your_city.edit', compact('item'));
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);
        $savedata = VoteForYourCity::where('id', $id)->first();
        $savedata->description = $request->description;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/vote_for_your_city')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        VoteForYourCity::where('id', $id)->delete();
        return redirect('/admin/vote_for_your_city')->with('success', 'Data Deleted Successful.');
    }
}
