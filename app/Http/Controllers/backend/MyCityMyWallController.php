<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\MyCityMyWall;
use Illuminate\Http\Request;

class MyCityMyWallController extends Controller
{
    public function index()

    {

        $data =  MyCityMyWall::get();
        return view('backend.service_menu.my_city_my_wall.index', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);

        $savedata = new MyCityMyWall();
        $savedata->description = $request->description;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/my_city_my_wall')->with('success', 'Data save Successful.');
    }
    public function update($id)
    {
        $item = MyCityMyWall::where('id', $id)->first();
        return view('backend.service_menu.my_city_my_wall.edit', compact('item'));
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);
        $savedata = MyCityMyWall::where('id', $id)->first();
        $savedata->description = $request->description;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/my_city_my_wall')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        MyCityMyWall::where('id', $id)->delete();
        return redirect('/admin/my_city_my_wall')->with('success', 'Data Deleted Successful.');
    }
}
