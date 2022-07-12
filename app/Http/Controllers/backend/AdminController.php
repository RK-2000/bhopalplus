<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $data = User::where('type', 'admin')->get();
        return view('backend.admin.index', compact('data'));
    }
    public function allservise()
    {
        return view('backend.all_service_menu');
    }


    public function create(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'mobile' => 'required|unique:users',
            'password'  => 'required',

        ]);

        $savedata = new User();
        $savedata->name = $request->name;
        $savedata->email = $request->email;
        $savedata->mobile = $request->mobile;
        $savedata->password =  Hash::make($request->password);
        $savedata->type = 'admin';
        $savedata->save();
        return redirect('/admin/admin')->with('success', 'Data save Successful.');
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);

        $savedata =  User::where('id', $id)->first();
        $savedata->name = $request->name;
        $savedata->email = $request->email;
        $savedata->mobile = $request->mobile;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/admin')->with('success', 'Data update Successful.');
    }
    public function delete($id)
    {

        User::where('id', $id)->delete();
        return redirect('/admin/admin')->with('success', 'Data Deleted Successful.');
    }
}
