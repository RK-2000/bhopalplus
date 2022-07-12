<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutUsController extends Controller
{
    public function index()
    {
        $data =  AboutUs::get();
        return view('backend.aboutus.index', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);

        $savedata = new AboutUs();
        $savedata->title = $request->title;
        $savedata->description = $request->description;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/aboutus')->with('success', 'Data save Successful.');
    }
    public function update($id)
    {
        $item = AboutUs::where('id', $id)->first();
        return view('backend.aboutus.edit', compact('item'));
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);
        $savedata = AboutUs::where('id', $id)->first();
        $savedata->description = $request->description;
        $savedata->title = $request->title;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/aboutus')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        AboutUs::where('id', $id)->delete();
        return redirect('/admin/aboutus')->with('success', 'Data Deleted Successful.');
    }
}
