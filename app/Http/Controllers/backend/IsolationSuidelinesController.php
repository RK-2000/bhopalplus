<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\IsolationSuidelines;
use Illuminate\Http\Request;

class IsolationSuidelinesController extends Controller
{
    public function index()

    {
        $data =  IsolationSuidelines::get();
        return view('backend.service_menu.IsolationSuidelines.isolation_suidelines', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);

        $savedata = new IsolationSuidelines();
        $savedata->description = $request->description;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/isolation_suidelines')->with('success', 'Data save Successful.');
    }
    public function update($id)
    {
        $item = IsolationSuidelines::where('id', $id)->first();
        return view('backend.service_menu.IsolationSuidelines.edit', compact('item'));
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);
        $savedata = IsolationSuidelines::where('id', $id)->first();
        $savedata->description = $request->description;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/isolation_suidelines')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        IsolationSuidelines::where('id', $id)->delete();
        return redirect('/admin/isolation_suidelines')->with('success', 'Data Deleted Successful.');
    }
}
