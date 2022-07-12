<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\TeleConsultationModel;
use Illuminate\Http\Request;

class TeleConsultationController extends Controller
{
    public function index()

    {
        $data =  TeleConsultationModel::get();
        return view('backend.service_menu.tele_consultation', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'phone_code' => 'required',
            'number' => 'required|unique:tele_consultation',
            'address'  => 'required',

        ]);

        $savedata = new TeleConsultationModel();
        $savedata->name = $request->name;
        $savedata->phone_code = $request->phone_code;
        $savedata->number = $request->number;
        $savedata->address = $request->address;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/teleconsultation')->with('success', 'Data save Successful.');
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required',
            'phone_code' => 'required',
            'number' => 'required|unique:tele_consultation',
            'address'  => 'required',

        ]);

        $savedata = TeleConsultationModel::where('id', $id)->first();
        $savedata->name = $request->name;
        $savedata->phone_code = $request->phone_code;
        $savedata->number = $request->number;
        $savedata->address = $request->address;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/teleconsultation')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        TeleConsultationModel::where('id', $id)->delete();
        return redirect('/admin/teleconsultation')->with('success', 'Data Deleted Successful.');
    }
}
