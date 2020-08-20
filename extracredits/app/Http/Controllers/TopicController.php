<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use App\Subcategory;
use App\Topic;

class TopicController extends Controller
{
    public function store(Request $request) {
        $topic = new Topic();
        $topic->name = $request->input('name');
        $topic->slug = Str::slug($request->input('name'), '-');
        $topic->subcategory_id = $request->get('subcategory_id');
        $topic->save();

        return redirect()->back();
    }
}
