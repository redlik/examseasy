<?php

namespace App\Http\Controllers;
use App\Subject;
use App\User;
use App\Lesson;
use App\Subcategory;
use App\Topic;
use App\Transaction;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
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
        $unlocked_lessons = Lesson::has('user')->get();
        $users = User::all();
        $transactions_number = DB::table('transactions')->count();
        $transactions = Transaction::all();
        return view('dashboard', compact('user', 'unlocked_lessons', 'subjects', 'active_students', 'transactions_number', 'transactions'));
    }

    public function dashboard_lessons() {
        $user = Auth::user();
        $lessons = Lesson::paginate(25);
        $subjects = DB::table('subjects')->orderBy('name', 'asc')->get();
        $subcategories = DB::table('subcategories')->orderBy('name', 'asc')->get();
        return view('dashboard.lessons', compact( "user", "subjects", "lessons", "subcategories"));
    }

    public function dashboard_lessons_search(Request $request) {
        $search_query = $request->get('searchInput');
        $lessons = Lesson::where('title', 'like', '%' . $search_query . '%')->orWhere('description', 'like', '%' . $search_query . '%' )->get();
        $subjects = DB::table('subjects')->orderBy('name', 'asc')->get();
        $subcategories = DB::table('subcategories')->orderBy('name', 'asc')->get();
        return view('dashboard.lessons', compact("lessons", "search_query", "subjects", "subcategories"));
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
        $unlocked = "Doesn't work";
        if ($lesson->user()->exists(Auth::id())) {
            $unlocked = true;
        }
        else {
            $unlocked = false;
        }

        return view('lessons.show', ['lesson' => $lesson, 'unlocked' => $unlocked]);
    }

    public function dashboard_students() {
        $students = User::role('student')->get();

        return view('dashboard.students', compact("students"));
    }

    public function dashboard_student_panel($id) {
        $user = User::where('id',$id)->first();
        $lessons = Lesson::has('user')->get();
        $today = Carbon::now();
        $transactions = Transaction::where('user_id', $user->id)->get();
        if (Carbon::parse($user->expiry_date)->greaterThan($today) ) {
            $valid = Carbon::parse($user->expiry_date)->diffInDays($today);
        }
        else {
            $valid = "Expired";
        }
        return view('dashboard.student_panel', compact("user", "lessons", "transactions", "valid"));
    }

    public function dashboard_student_add_credits(Request $request) {
        $user = User::where('id', (int)$request->input('student_id'))->first();
        $user->credits = $user->credits + $request->input('creditTopupRadio');
        $user->save();

        return redirect()->back();
    }

    public function dashboard_categories() {
        // $subjects = DB::table('subjects')
        //     ->orderBy('name', 'asc')
        //     ->get();
        $subjects = Subject::with('subcategory')->orderby('name', 'asc')->get();
        $subcategories = Subcategory::withCount('subject')->get();
        $topics = Topic::with('subcategory')->get();
        return view('dashboard.categories', compact("subjects", "subcategories", "topics"));
    }

    public function dashboard_subjects($subject_name) {
        $subjects = Subject::all();
        $selected_subject = Subject::where('name', $subject_name)->first();
        $subcategories = Subcategory::where('subject_id', $selected_subject->id)->orderby('order_position', 'asc')->get();
        $topics = Topic::orderby('order_position', 'asc')->get();

        return view('dashboard.subjects', compact("subjects", "selected_subject", "subcategories", "topics"));

    }

    public function dashboard_transactions() {
        $transactions = Transaction::paginate(25);

        return view('dashboard.transactions', compact("transactions"));
    }
    
    public function dashboard_emails() {
        

        return view('dashboard.emails');
    }

    public function user_panel($id) {
        if ( $id != Auth::id() ) {
            return response("<h2>You are not authorised to view this page.</h2>", 403);
        }
        else {
            $user = User::where('id',$id)->first();
            // $lessons = Lesson::withCount('user')->get();
            // $lessons = Lesson::where('user_id', $id)->get();
            $lessons = User::find($id)->lesson()->get();
            $transactions = Transaction::where('user_id', $id)->get();
            $today = Carbon::now();
            if (Carbon::parse($user->expiry_date)->greaterThan($today) ) {
                $valid = Carbon::parse($user->expiry_date)->diffInDays($today);
            }
            else {
                $valid = "Expired";
            }
            return view('user_panel', compact("user", "lessons", "transactions", "valid"));
        }
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

        $transactions = Transaction::has('user')->get();    
        $lessons = Lesson::withCount('user')->get();

        return view('user_panel', compact("user", "lessons", "transactions"));
    }

    public function subjects() {
        $subjects = Subject::orderby('name', 'asc')->get();
        // $subjects = $subjects->whereNotIn('id', [8, 10]);
        return view('pages.subjects', compact('subjects'));
    }

    public function myvideos() {
        $user = Auth::user();
        $lessons = User::find($user->id)->lesson()->orderby('subject_id', 'asc')->get();

        return view('pages.myvideos', compact('lessons'));

    }
}
