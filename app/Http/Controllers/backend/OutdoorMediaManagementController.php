<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\OutdoorMediaManagement;
use Illuminate\Http\Request;

class OutdoorMediaManagementController extends Controller
{

    public function index()
    {

        $data =  OutdoorMediaManagement::get();
        return view('backend.service_menu.outdoor_media_management.index', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);

        $savedata = new OutdoorMediaManagement();
        $savedata->description = $request->description;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/outdoor_media_management')->with('success', 'Data save Successful.');
    }
    public function update($id)
    {
        $item = OutdoorMediaManagement::where('id', $id)->first();
        return view('backend.service_menu.outdoor_media_management.edit', compact('item'));
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);
        $savedata = OutdoorMediaManagement::where('id', $id)->first();
        $savedata->description = $request->description;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/outdoor_media_management')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        OutdoorMediaManagement::where('id', $id)->delete();
        return redirect('/admin/outdoor_media_management')->with('success', 'Data Deleted Successful.');
    }
}
