<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SmartQrScanner;
use Illuminate\Http\Request;

class SmartQrScannerController extends Controller
{

    public function index()
    {

        $data =  SmartQrScanner::get();
        return view('backend.service_menu.smart_qr_scanner.index', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);

        $savedata = new SmartQrScanner();
        $savedata->description = $request->description;
        $savedata->status = '1';
        $savedata->save();
        return redirect('/admin/smart_qr_scanner')->with('success', 'Data save Successful.');
    }
    public function update($id)
    {
        $item = SmartQrScanner::where('id', $id)->first();
        return view('backend.service_menu.smart_qr_scanner.edit', compact('item'));
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'description' => 'required',

        ]);
        $savedata = SmartQrScanner::where('id', $id)->first();
        $savedata->description = $request->description;
        $savedata->status = $request->status;
        $savedata->update_at = date('Y-m-d H:i:s');
        $savedata->save();
        return redirect('/admin/smart_qr_scanner')->with('success', 'Data Update Successful.');
    }
    public function delete($id)
    {

        SmartQrScanner::where('id', $id)->delete();
        return redirect('/admin/smart_qr_scanner')->with('success', 'Data Deleted Successful.');
    }
}
