<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PublicBikeSharing;
use Illuminate\Http\Request;

class PublicbikesharingController extends Controller
{
    public function index()
    {
        $data =  PublicBikeSharing::get();
        return view('backend.service_menu.public_bile_sharing.index', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);

        $savedata = new PublicBikeSharing();
        $savedata->description = $request->description;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/public_bike_sharing')->with('success', 'Data save Successful.');
    }
    public function update($id)
    {
        $item = PublicBikeSharing::where('id', $id)->first();
        return view('backend.service_menu.public_bile_sharing.edit', compact('item'));
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);
        $savedata = PublicBikeSharing::where('id', $id)->first();
        $savedata->description = $request->description;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/public_bike_sharing')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        PublicBikeSharing::where('id', $id)->delete();
        return redirect('/admin/public_bike_sharing')->with('success', 'Data Deleted Successful.');
    }
}
