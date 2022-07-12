<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BedCategoryModel;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class BedController extends Controller
{
    public function index()
    {
        $data = BedCategoryModel::get();
        return view('backend.bedCategory.index', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required',
            'available' => 'required',
            'capacity'  => 'required',
        ]);

        $spkAdmin = BedCategoryModel::create($request->all());
        return redirect('/admin/bed')->with('success', 'Data save Successful.');
    }
    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'available' => 'required',
            'capacity'  => 'required',
            'status' =>  'required',
        ]);

        $data =  BedCategoryModel::where('id', $id)->first();
        $data->title = $request->title;
        $data->available  = $request->available;
        $data->capacity  = $request->capacity;
        $data->status = $request->status;
        $data->update_at = date('Y-m-d H:i:s');
        $data->save();
        return redirect('/admin/bed')->with('success', 'Data update Successful.');
    }
    public function delete($id)
    {

        BedCategoryModel::where('id', $id)->delete();
        return redirect('/admin/bed')->with('success', 'Data Deleted Successful.');
    }
}
