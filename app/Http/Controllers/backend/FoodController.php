<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FoodController extends Controller
{
    public function index()

    {

        $data =  Food::get();
        return view('backend.service_menu.food', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'phone_code' => 'required',
            'number' => 'required|unique:food',
            'address'  => 'required',

        ]);

        $savedata = new Food();
        $savedata->name = $request->name;
        $savedata->phone_code = $request->phone_code;
        $savedata->number = $request->number;
        $savedata->address = $request->address;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/food')->with('success', 'Data save Successful.');
    }
    public function edit(Request $request, $id)
    {


        $validated = $request->validate([
            'name' => 'required',
            'phone_code' => 'required',
            'number' => 'required|unique:food',
            'address'  => 'required',

        ]);

        $savedata = Food::where('id', $id)->first();
        $savedata->name = $request->name;
        $savedata->phone_code = $request->phone_code;
        $savedata->number = $request->number;
        $savedata->address = $request->address;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/food')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        Food::where('id', $id)->delete();
        return redirect('/admin/food')->with('success', 'Data Deleted Successful.');
    }
}
