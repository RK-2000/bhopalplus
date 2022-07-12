<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ServiceModel;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $data = ServiceModel::get();

        return view('backend.servicecategory.index', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required',
            'icon' => 'required'
        ]);
        $filename = time() . '.' . request()->icon->getClientOriginalExtension();
        request()->icon->move(public_path('backend/image'), $filename);

        $spkAdmin = new ServiceModel();
        $spkAdmin->title = $request->title;
        $spkAdmin->icon = $filename;
        $spkAdmin->url =  $request->url;
        $spkAdmin->status = 1;
        $spkAdmin->save();
        return redirect('/admin/service')->with('success', 'Data save Successful.');
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'title' => 'required',
            'status' =>  'required',
        ]);

        $data =  ServiceModel::where('id', $id)->first();

        if ($request->icon) {
            $filename = time() . '.' . request()->icon->getClientOriginalExtension();
            request()->icon->move(public_path('backend/image'), $filename);
            $data->icon  = $filename;
        }

        $data->title = $request->title;
        $data->url  = $request->url;
        $data->status = $request->status;
        $data->save();
        return redirect('/admin/service')->with('success', 'Data update Successful.');
    }
    public function delete($id)
    {

        ServiceModel::where('id', $id)->delete();
        return redirect('/admin/service')->with('success', 'Data Deleted Successful.');
    }
}
