<?php

namespace App\Http\Controllers;
use App\Lesson;
use App\Subject;
use App\Level;
use App\User;
use App\Subcategory;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use DB;

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
        if (Auth::user()) {
            $credits = $user->credits;
            return view('lessons/index', ['lessons' => $lessons, 'credits' => $credits]);
        }
        else {
            return view('lessons/index', ['lessons' => $lessons, 'credits' => '0']);
        }

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
        $category = Subcategory::find($request->input('subjectCategory'));

        $request->validate(['thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);

        $thumbnail = $request->file('thumbnail');
        $thumbnail_name = $thumbnail->getClientOriginalName();

        $new_filename = time().'-'.$thumbnail_name;

        $lesson = new Lesson();
        $lesson->title = $request->input('title');
        $lesson->link = $request->input('link');
        $lesson->thumbnail = $new_filename;
        $lesson->description = $request->input('description');
        $lesson->subject_id = $request->get('subjectSelect');
        $lesson->category_id = $request->get('subjectCategory');
        $lesson->level_id = $request->get('levelSelect');
        $lesson->save();

        $thumbnail->move(public_path('images/thumbnails'), $new_filename);

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);

        return view('lessons.show', ['lesson' => $lesson]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::find($id);
        $subjects = Subject::all()->sortBy('name');
        $levels = Level::all();
        $subcategories = Subcategory::where('subject_id', $lesson->subject_id)->get()->sortBy('name');

        return view('lessons.edit', ['lesson' => $lesson, 'subjects' => $subjects, 'levels' => $levels, 'subcategories' => $subcategories]);

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
        $lesson = Lesson::find($id);

        $lesson->title = $request->input('title');

        $lesson->save();

        return redirect('dashboard');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        $lesson->delete();
        return redirect('dashboard');
    }

    public function remove($id) {
        $lesson = Lesson::find($id);
        $lesson->delete();
        return redirect('dashboard');
    }

    public static function isUnlocked($lesson_id) {
        
        $subjects = Subject::all();
        $lesson_id = $lesson_id;
        $current_lesson = Lesson::find($lesson_id);
        $id = Auth::user()->id;
        $currentuser = User::find($id);
        $credits = $currentuser->credits;
        $currentuser->credits = $credits -1;
        $currentuser->lesson()->attach($lesson_id);
        $currentuser->save();

        return view('lessons.subjects', ['subjects' => $subjects, 'credits' => $credits]);
    }

    public function subjects($subject_name) {
        if (Auth::user()) {
            $user = Auth::user();
            $credits = $user->credits;
            $subject_name = $subject_name;
            $subject = Subject::where('name', $subject_name)->first();
            $subject_id = $subject->id;
            $lessons = Lesson::where('subject_id', $subject_id)->get();
            return view('lessons/index', ['lessons' => $lessons, 'subject'=>$subject_name, 'credits'=>$credits]);
        }
        else {
          return redirect()->route('login'); 
        }
    }

    public function subjectsView() {
        $subjects = Subject::all();
        $user = Auth::user();
        $credits = $user->credits;
        return view('lessons.subjects', ['subjects' => $subjects, 'credits' => $credits]);
    }

    public function getCategory($subject_id) {
        echo json_encode(DB::table('subcategories')->where('subject_id', $subject_id)->get());
    }
}
