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
        $topic->order_position = $request->get('topic_order_position');
        $topic->save();

        $topic->slug = $topic->id."-".$topic->slug;
        $topic->save();

        return redirect()->back();
    }

    public function update(Request $request) {
        $request->validate(['name' => 'required',
                            'topic_order_position' => 'required',
                            ]);


        $topic = Topic::find($request->input('editTopicId'));
        $topic->name = $request->input('name');
        $topic->order_position = (int)$request->get('topic_order_position');
        $topic->slug = $topic->id."-".Str::slug($request->input('name'), '-');
        $topic->save();

        return redirect()->back();

    }

    public function destroy($topic)
    {
        $topic = Topic::find($topic);
        $topic->delete();

        return redirect()->back();
    }

}
