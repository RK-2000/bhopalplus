<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\MultiLevelParking;
use Illuminate\Http\Request;

class MultiLevelParkingController extends Controller
{
    public function index()

    {
        $data =  MultiLevelParking::get();
        return view('backend.service_menu.multi_level_parking.index', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);

        $savedata = new MultiLevelParking();
        $savedata->description = $request->description;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/multi_level_parking')->with('success', 'Data save Successful.');
    }
    public function update($id)
    {
        $item = MultiLevelParking::where('id', $id)->first();
        return view('backend.service_menu.multi_level_parking.edit', compact('item'));
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);
        $savedata = MultiLevelParking::where('id', $id)->first();
        $savedata->description = $request->description;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/multi_level_parking')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        MultiLevelParking::where('id', $id)->delete();
        return redirect('/admin/multi_level_parking')->with('success', 'Data Deleted Successful.');
    }
}
