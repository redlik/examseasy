<?php

namespace App\Http\Controllers;
use App\Lesson;
use App\Subject;
use App\Level;
use App\User;
use App\Subcategory;
use App\Topic;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
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
        $user = Auth::user();
        $subjects = Subject::all()->sortBy('name');
        $levels = Level::all();
        return view('lessons/create', ['subjects' => $subjects, 'levels' => $levels, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $level = Level::find($request->input('levelSelect'));
        // $topic = Topic::find($request->input('topicSelection'));

        $user = Auth::user();

        $request->validate(['thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
                            'title' => 'required|unique:lessons',
                            'description' => 'required',
                            'link' => 'required|url',
                            ]);

        $thumbnail = $request->file('thumbnail');
        $thumbnail_name = $thumbnail->getClientOriginalName();

        $new_filename = time().'-'.$thumbnail_name;

        $lesson = new Lesson();
        $lesson->title = $request->input('title');
        $lesson->slug = Str::slug($request->input('title'), '-');
        $lesson->link = $request->input('link');
        $lesson->thumbnail = $new_filename;
        $lesson->description = $request->input('description');
        $lesson->topic_id = $request->get('topicSelection');
        $lesson->subject_id = $request->get('subjectSelect');
        $lesson->credit_cost = (int)$request->get('creditCost');
        $lesson->level_id = $request->get('levelSelect');
        $lesson->author_id = $user->id;
        $lesson->save();

        $thumbnail->move(public_path('images/thumbnails'), $new_filename);

        return redirect('dashboard/lessons');
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
        $topics = Topic::all();
        $subcategories = Subcategory::where('subject_id', $lesson->subject_id)->get()->sortBy('name');
        $topic = Topic::find($lesson->topic_id);
        $selected_subcategory = Subcategory::find($topic->subcategory_id);

        return view('lessons.edit', ['lesson' => $lesson, 'subjects' => $subjects, 'levels' => $levels, 'subcategories' => $subcategories, 'selected_subcategory' => $selected_subcategory, 'topics'=>$topics]);

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
        
        $request->validate(['title' => 'required',
                            'description' => 'required',
                            'link' => 'required|url',
                            ]);

        $lesson->title = $request->input('title');
        $lesson->slug = Str::slug($request->input('title'), '-');
        $lesson->link = $request->input('link');
        $lesson->description = $request->input('description');
        $lesson->subject_id = $request->get('subjectSelect');
        $lesson->topic_id = $request->get('topicSelection');
        $lesson->level_id = $request->get('levelSelect');
        $lesson->credit_cost = (int)$request->get('creditCost');

        if ($request->has('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->getClientOriginalName();
            $new_filename = time().'-'.$thumbnail_name;
            $lesson->thumbnail = $new_filename;
            $thumbnail->move(public_path('images/thumbnails'), $new_filename);
        }

        $lesson->save();


        return redirect('dashboard/lessons');

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
        return redirect('dashboard/lessons');
    }

    public function remove($id) {
        $lesson = Lesson::find($id);
        $lesson->delete();
        return redirect('dashboard/lessons');
    }

    public static function isUnlocked($lesson_id) {
        
        $subjects = Subject::all();
        $lesson_id = $lesson_id;
        $current_lesson = Lesson::find($lesson_id);
        $id = Auth::user()->id;
        $currentuser = User::find($id);
        $credits = $currentuser->credits;
        $currentuser->credits = $credits - $current_lesson->credit_cost;
        $currentuser->lesson()->attach($lesson_id);
        $currentuser->save();

        return view('lessons.subjects', ['subjects' => $subjects, 'credits' => $credits]);
    }

    public function subjects($subject_name) {
        if (Auth::user()) {
            $user = Auth::user();
            $credits = $user->credits;
        }
        else {
            $credits = 0;
        }
        $subject = Subject::where('name', $subject_name)->first();
        $subject_id = $subject->id;
        $subcategories = Subcategory::where('subject_id', $subject_id)->has('topic')->orderBy('order_position', 'asc')->get();
        $lessons = Lesson::where('subject_id', $subject_id)->get();
        $topics = Topic::has('subcategory')->has('lesson')->orderBy('order_position', 'asc')->get();
        return view('lessons.subject-view', compact('lessons', 'subject', 'credits', 'subcategories', 'topics'));
        
        // else {
        //   return redirect()->route('login'); 
        // }
    }

    public function subject_category($subject, $category) {
        $subject = Subject::where('name', $subject)->first();
        $category = Subcategory::where('slug', $category)->first();
        $topics = Topic::where('subcategory_id', $category->id)->has('lesson')->get();
        $lessons = Lesson::with('topic')->get();
        return view('lessons.subject-category', compact('category', 'topics', 'lessons'));
    }
    
    public function subject_category_topic($subject, $category, $topic) {
        $topic = Topic::where('slug', $topic)->first();
        $lessons = Lesson::where('topic_id', $topic->id)->get();
        return view('lessons.subject-category-topic', compact('topic', 'lessons'));
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
