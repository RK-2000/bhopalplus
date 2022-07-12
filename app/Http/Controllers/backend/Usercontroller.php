<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Otp;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class Usercontroller extends Controller
{
    public function index()
    {
        $data = User::where('type', 'user')->get();
        // $datam = Crypt::decryptString(Auth::user()->password);
        // $decryptString = Crypt::decryptString(Auth::user()->password);

        $password = 'pass1234';

        // $encryptedPassword = encrypt($password);
        // $pass = Auth::user()->password;
        // $decryptedPassword = decrypt($pass);
        // dd($decryptedPassword);
        return view('backend.user.index', compact('data'));
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
        $savedata->type = 'user';
        $savedata->save();
        return redirect('/admin/user')->with('success', 'Data save Successful.');
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
        return redirect('/admin/user')->with('success', 'Data update Successful.');
    }
    public function delete($id)
    {

        User::where('id', $id)->delete();
        Otp::where('user_id', $id)->delete();
        return redirect('/admin/user')->with('success', 'Data Deleted Successful.');
    }
}
