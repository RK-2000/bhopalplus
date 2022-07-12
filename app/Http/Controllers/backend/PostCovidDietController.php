<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PostcovidDiet;
use Illuminate\Http\Request;

class PostCovidDietController extends Controller
{
    public function index()
    {

        $data = PostcovidDiet::get();
        return view('backend.service_menu.post_covid_diet', compact('data'));
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required',
            'icon' => 'required'
        ]);
        $filename = time() . '.' . request()->icon->getClientOriginalExtension();
        request()->icon->move(public_path('backend/image/postcoviddiet'), $filename);

        $spkAdmin = new PostcovidDiet();
        $spkAdmin->title = $request->title;
        $spkAdmin->image = $filename;
        $spkAdmin->status = 1;
        $spkAdmin->save();
        return redirect('/admin/post_covid_diet')->with('success', 'Data save Successful.');
    }
    public function edit(Request $request, $id)
    {

        $validated = $request->validate([
            'title' => 'required',
            'status' =>  'required',
        ]);

        $data =  PostcovidDiet::where('id', $id)->first();

        if ($request->icon) {
            $filename = time() . '.' . request()->icon->getClientOriginalExtension();
            request()->icon->move(public_path('backend/image/postcoviddiet'), $filename);
            $data->image  = $filename;
        }

        $data->title = $request->title;
        $data->status = $request->status;
        $data->update_at = date('Y-m-d H:i:s');
        $data->save();
        return redirect('/admin/post_covid_diet')->with('success', 'Data update Successful.');
    }
    public function delete($id)
    {

        PostcovidDiet::where('id', $id)->delete();
        return redirect('/admin/post_covid_diet')->with('success', 'Data Deleted Successful.');
    }
}
