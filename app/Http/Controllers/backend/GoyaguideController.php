<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\YogaGuideModel;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Models\ImageModel;
use App\Models\YoutubelinkModel;

class GoyaguideController extends Controller
{
    public function index()
    {
        $data = YogaGuideModel::with('imageyoga', 'youtubelink')->get();

        return view('backend.service_menu.yoga_guide', compact('data'));
    }
    public function editpath($id)
    {

        $data = YogaGuideModel::where('id', $id)->first();
        $youtube = YoutubelinkModel::where('yoga_guide_id', $id)->get();
        $image = ImageModel::where('image_id', $id)->get();

        return view('backend.service_menu.yoga_guide_edit', compact('data', 'youtube', 'image'));
    }


    public function create(Request $request)
    {


        $validated = $request->validate([
            'title' => 'required',
            'date_time' => 'required',
            'google_meet_url' => 'required',
        ]);


        $yoga = new YogaGuideModel();
        $yoga->title = $request->title;
        $yoga->google_meet_url = $request->google_meet_url;
        $yoga->date_time =  $request->date_time;
        $yoga->contact_address =  $request->contact_address;
        $yoga->contact_number =  $request->contact_number;
        $yoga->description_agenda =  $request->description_agenda;
        $yoga->save();

        foreach ($request->file('banner_image') as $image) {
            $filename = rand() . $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();
            $imagedata =  $image->move(public_path('backend/image/yoga/'), $filename);

            $image = new ImageModel();
            $image->name = $filename;
            $image->path = $imagedata;
            $image->image_id = $yoga->id;
            $image->type = 'yogaguide';
            $image->save();
        }
        foreach ($request->youtube_link as $key => $valuelink) {

            $youtube = new YoutubelinkModel();
            $youtube->yoga_guide_id = $yoga->id;
            $youtube->type = 'yogaguide';
            $youtube->url = $valuelink;
            $youtube->save();
        }


        return redirect('/admin/yoga_guide')->with('success', 'Data save Successful.');
    }
    public function delete($id)
    {
        YogaGuideModel::where('id', $id)->delete();
        return redirect('/admin/yoga_guide')->with('success', 'Data Deleted Successful.');
    }
    public function imagedelete($id)
    {
        ImageModel::where('id', $id)->delete();

        return redirect('/admin/yoga_guide')->with('success', 'Image Deleted Successful.');
    }
    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'date_time' => 'required',
            'google_meet_url' => 'required',
        ]);


        $yoga = YogaGuideModel::where('id', $id)->first();
        $yoga->title = $request->title;
        $yoga->google_meet_url = $request->google_meet_url;
        $yoga->date_time =  $request->date_time;
        $yoga->contact_address =  $request->contact_address;
        $yoga->contact_number =  $request->contact_number;
        $yoga->description_agenda =  $request->description_agenda;
        $yoga->update_at = date('Y-m-d H:i:s');
        $yoga->save();
        if ($request->file('banner_image')) {
            foreach ($request->file('banner_image') as $image) {
                $filename = rand() . $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();
                $imagedata =  $image->move(public_path('backend/image/yoga/'), $filename);

                $image = new ImageModel();
                $image->name = $filename;
                $image->path = $imagedata;
                $image->image_id = $yoga->id;
                $image->type = 'yogaguide';
                $image->save();
            }
        }
        if ($request->youtube_link) {
            foreach ($request->youtube_link as $key => $valuelink) {
                $youtube = new YoutubelinkModel();
                $youtube->yoga_guide_id = $yoga->id;
                $youtube->type = 'yogaguide';
                $youtube->url = $valuelink;
                $youtube->save();
            }
        }


        return redirect('/admin/yoga_guide')->with('success', 'Data save Successful.');
    }
}
