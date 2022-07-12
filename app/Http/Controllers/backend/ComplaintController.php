<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $data =  Complaint::with('user')->get();
        return view('backend.complaint', compact('data'));
    }

    public function delete($id)
    {
        Complaint::where('id', $id)->delete();
        return redirect('/admin/complaint')->with('success', 'Data Deleted Successful.');
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'admin_rply_message' => 'required'

        ]);

        $savedata = Complaint::where('id', $id)->first();
        $savedata->admin_rply_message = $request->admin_rply_message;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/complaint')->with('success', 'Data Update Successful.');
    }
}
