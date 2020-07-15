<?php

namespace App\Http\Controllers;
use App\Lesson;
use App\Subject;
use App\Level;
use App\User;
use Auth;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $lessons = Lesson::all();
        $credits = $user->credits;
        return view('lessons/index', ['lessons' => $lessons, 'credits' => $credits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all()->sortBy('name');
        $levels = Level::all();
        return view('lessons/create', ['subjects' => $subjects, 'levels' => $levels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = Subject::find($request->input('subjectSelect'));
        $level = Level::find($request->input('levelSelect'));

        $request->validate(['thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);

        $thumbnail = $request->file('thumbnail');
        $thumbnail_name = $thumbnail->getClientOriginalName();

        $new_filename = time().'-'.$thumbnail_name;

        $lesson = new Lesson();
        $lesson->title = $request->input('title');
        $lesson->link = $request->input('title');
        $lesson->thumbnail = $new_filename;
        $lesson->description = $request->input('description');
        $lesson->subject_id = $request->get('subjectSelect');
        $lesson->level_id = $request->get('levelSelect');
        $lesson->save();

        $thumbnail->move(public_path('images/thumbnails'), $new_filename);

        return redirect('lessons');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public static function isUnlocked($lesson_id) {
        
        $lesson_id = $lesson_id;
        $current_lesson = Lesson::find($lesson_id);
        $id = Auth::user()->id;
        $currentuser = User::find($id);
        $credits = $currentuser->credits;
        $currentuser->credits = $credits -1;
        $currentuser->unlocked_lesson()->attach($lesson_id);
        $currentuser->save();

        

        return redirect('lessons');
    }
}
