<?php

namespace App\Http\Controllers;
use App\Subject;
use App\User;
use App\Lesson;
use App\Subcategory;
use App\Topic;
use Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class PagesController extends Controller
{
    public function home() {
        $subjects = Subject::all();
        return view('index', ['subjects' => $subjects]);
    }

    public function dashboard() {
        $active_students = count(User::role('student')->get());
        $user = Auth::user();
        $subjects = Subject::all();
        $lessons = Lesson::withCount('user')->get();
        $users = User::all();
        return view('dashboard', ['user' => $user, 'lessons'=> $lessons, 'users'=>$users, 'subjects' => $subjects, 'active_students' => $active_students]);
    }

    public function dashboard_lessons() {
        $user = Auth::user();
        $lessons = Lesson::all();
        $subjects = DB::table('subjects')->orderBy('name', 'asc')->get();
        $subcategories = DB::table('subcategories')->orderBy('name', 'asc')->get();
        return view('dashboard.lessons', compact( "user", "subjects", "lessons", "subcategories"));
    }

    public function dashboard_lessons_search(Request $request) {
        $search_query = $request->get('searchInput');
        $lessons = Lesson::where('title', 'like', '%' . $search_query . '%')->orWhere('description', 'like', '%' . $search_query . '%' )->get();
        return view('dashboard.lessons', compact("lessons", "search_query"));
    }

    public function dashboard_lessons_filter (Request $request) {
        $filter = $request->get('selectFilter');
        if (strpos($filter, 'sub-' ) !== false) {
            $subject = (int)substr($filter, 4);
            $lessons = Lesson::where('subject_id', $subject)->get();
            $subjects = DB::table('subjects')->orderBy('name', 'asc')->get();
            $subcategories = DB::table('subcategories')->orderBy('name', 'asc')->get();
            $selected_subject = Subject::find($subject);
            return view('dashboard.lessons', compact("lessons", "subjects", "subcategories", "selected_subject"));
        } else {
            $category = (int)substr($filter, 9);
            // $subject = (int)
            $lessons = Lesson::whereHas('topic', function ($builder) use ($category) {
                $builder->where('subcategory_id', $category);
            })->get();
            $subjects = DB::table('subjects')->orderBy('name', 'asc')->get();
            $subcategories = DB::table('subcategories')->orderBy('name', 'asc')->get();
            $selected_category = Subcategory::find($category);
            // dd($lessons);
            return view('dashboard.lessons', compact("lessons", "subjects", "subcategories", "selected_category"));
        }

        
    }

    public function lesson_view($subject, $subcategory, $topic, $lesson_slug) {
        $lesson = Lesson::where('slug', $lesson_slug)->first();

        return view('lessons.show', ['lesson' => $lesson]);
    }

    public function dashboard_students() {
        $students = User::role('student')->get();

        return view('dashboard.students', compact("students"));
    }

    public function dashboard_categories() {
        $user = Auth::user();
        $subjects = Subject::all();
        $subcategories = Subcategory::orderBy('name', 'asc')->get();
        $topics = Topic::orderBy('name', 'asc')->get();
        return view('dashboard.categories', compact("user", "subjects", "subcategories", "topics"));
    }

    public function user_panel($id) {
        $user = User::where('id',$id)->first();
        $lessons = Lesson::withCount('user')->get();
        return view('user_panel', ['user' => $user, 'lessons' => $lessons]);
    }

    public function buy_credits() {
        return view('buycredits');
    }

    public function topup(Request $request) {
        $user = Auth::user();
        $topup = (int)$request->get('topup');
        $credit = $user->credits;
        $new_credit = $credit + $topup;
        $user->credits = $new_credit;
        $user->save();

        $lessons = Lesson::withCount('user')->get();

        return view('user_panel', ['user' => $user, 'lessons' => $lessons]);

    }
}
