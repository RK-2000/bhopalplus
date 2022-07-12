<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\DeathRegistration;
use Illuminate\Http\Request;

class DeathRegistrationController extends Controller
{
    public function index()
    {

        $data =  DeathRegistration::get();
        return view('backend.service_menu.death_registration.index', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);

        $savedata = new DeathRegistration();
        $savedata->description = $request->description;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/death_registration')->with('success', 'Data save Successful.');
    }
    public function update($id)
    {
        $item = DeathRegistration::where('id', $id)->first();
        return view('backend.service_menu.death_registration.edit', compact('item'));
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);
        $savedata = DeathRegistration::where('id', $id)->first();
        $savedata->description = $request->description;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/death_registration')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        DeathRegistration::where('id', $id)->delete();
        return redirect('/admin/death_registration')->with('success', 'Data Deleted Successful.');
    }
}
