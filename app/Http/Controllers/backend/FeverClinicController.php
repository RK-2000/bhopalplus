<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Feverclinic;
use Illuminate\Http\Request;

class FeverClinicController extends Controller
{
    public function index()

    {
        $data =  Feverclinic::get();
        return view('backend.service_menu.fever_clinic', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'phone_code' => 'required',
            'number' => 'required|unique:fever_clinic',
            'address'  => 'required',

        ]);

        $savedata = new Feverclinic();
        $savedata->name = $request->name;
        $savedata->phone_code = $request->phone_code;
        $savedata->number = $request->number;
        $savedata->address = $request->address;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/fever_clinic')->with('success', 'Data save Successful.');
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required',
            'phone_code' => 'required',
            'number' => 'required|unique:fever_clinic',
            'address'  => 'required',

        ]);

        $savedata = Feverclinic::where('id', $id)->first();
        $savedata->name = $request->name;
        $savedata->phone_code = $request->phone_code;
        $savedata->number = $request->number;
        $savedata->address = $request->address;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/fever_clinic')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        Feverclinic::where('id', $id)->delete();
        return redirect('/admin/fever_clinic')->with('success', 'Data Deleted Successful.');
    }
}
