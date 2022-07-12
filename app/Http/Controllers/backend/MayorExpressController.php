<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\MayorExpress;
use Illuminate\Http\Request;

class MayorExpressController extends Controller
{
    public function index()

    {
        $data =  MayorExpress::get();
        return view('backend.service_menu.mayor_express.index', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);

        $savedata = new MayorExpress();
        $savedata->description = $request->description;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/mayor_express')->with('success', 'Data save Successful.');
    }
    public function update($id)
    {
        $item = MayorExpress::where('id', $id)->first();
        return view('backend.service_menu.mayor_express.edit', compact('item'));
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);
        $savedata = MayorExpress::where('id', $id)->first();
        $savedata->description = $request->description;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/mayor_express')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        MayorExpress::where('id', $id)->delete();
        return redirect('/admin/mayor_express')->with('success', 'Data Deleted Successful.');
    }
}
