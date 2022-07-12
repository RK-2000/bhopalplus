<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()

    {

        $data =  Feedback::with('user')->get();


        return view('backend.feedback', compact('data'));
    }
    public function delete($id)
    {

        Feedback::where('id', $id)->delete();
        return redirect('/admin/feedback')->with('success', 'Data Deleted Successful.');
    }
}
