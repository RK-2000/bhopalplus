<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ContactPsychlogist;
use Illuminate\Http\Request;

class ContactPsychlogistController extends Controller
{
    public function index()
    {
        $data =  ContactPsychlogist::get();

        return view('backend.service_menu.contactpsychlogist', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'phone_code' => 'required',
            'number' => 'required|unique:tele_consultation',
            'address'  => 'required',

        ]);

        $savedata = new ContactPsychlogist();
        $savedata->name = $request->name;
        $savedata->phone_code = $request->phone_code;
        $savedata->number = $request->number;
        $savedata->address = $request->address;
        $savedata->type = $request->type;
        $savedata->status = '1';

        $savedata->save();
        return redirect('/admin/contactpsychlogist')->with('success', 'Data save Successful.');
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required',
            'phone_code' => 'required',
            'number' => 'required|unique:tele_consultation',
            'address'  => 'required',

        ]);

        $savedata = ContactPsychlogist::where('id', $id)->first();
        $savedata->name = $request->name;
        $savedata->phone_code = $request->phone_code;
        $savedata->number = $request->number;
        $savedata->address = $request->address;
        $savedata->status = $request->status;
        $savedata->type = $request->type;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/contactpsychlogist')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        ContactPsychlogist::where('id', $id)->delete();
        return redirect('/admin/contactpsychlogist')->with('success', 'Data Deleted Successful.');
    }
}
