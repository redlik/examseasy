<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Paperadvice;


class PaperadviceController extends Controller
{
    public function index()
    {
        $videos = Paperadvice::all();

        return view('pages.advicevideos', compact('videos'));
    }

    public function dashboard_index() 
    {
        $videos = Paperadvice::all();

        return view('dashboard.paperadvice', compact('videos'));
    }

    public function create()
    {
        return view('dashboard.paperadvice');
    }

    public function store(Request $request) 
    {
        
        $video = Paperadvice::create($request->all());
        $video->slug = $video->id."-".Str::slug($request->input('title'), '-');

        $video->save();

        return redirect('dashboard/paperadvice');
    }

    public function destroy($id)
    {
        $video = Paperadvice::where('id', $id)->first();
        $video->delete();

        return redirect('dashboard/paperadvice');
    }
}
