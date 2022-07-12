<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\VacinationCenter;
use Illuminate\Http\Request;

class VacinationCenterController extends Controller
{
    public function index()

    {
        $data =  VacinationCenter::get();
        return view('backend.service_menu.vacination_center', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'address'  => 'required',

        ]);

        $savedata = new VacinationCenter();
        $savedata->name = $request->name;
        $savedata->address = $request->address;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/vacination_center')->with('success', 'Data save Successful.');
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required',
            'address'  => 'required',

        ]);

        $savedata = VacinationCenter::where('id', $id)->first();
        $savedata->name = $request->name;
        $savedata->address = $request->address;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/vacination_center')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        VacinationCenter::where('id', $id)->delete();
        return redirect('/admin/vacination_center')->with('success', 'Data Deleted Successful.');
    }
}
