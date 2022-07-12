<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BirthRegistration;
use Illuminate\Http\Request;

class BirthRegistrationController extends Controller
{
    public function index()
    {

        $data =  BirthRegistration::get();
        return view('backend.service_menu.birth_registration.index', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);

        $savedata = new BirthRegistration();
        $savedata->description = $request->description;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/birth_registration')->with('success', 'Data save Successful.');
    }
    public function update($id)
    {
        $item = BirthRegistration::where('id', $id)->first();
        return view('backend.service_menu.birth_registration.edit', compact('item'));
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);
        $savedata = BirthRegistration::where('id', $id)->first();
        $savedata->description = $request->description;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/birth_registration')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        BirthRegistration::where('id', $id)->delete();
        return redirect('/admin/birth_registration')->with('success', 'Data Deleted Successful.');
    }
}
