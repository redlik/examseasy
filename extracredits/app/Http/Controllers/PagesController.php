<?php

namespace App\Http\Controllers;
use App\Subject;
use App\User;
use App\Lesson;
use Auth;
use DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

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
        $subjects = DB::table('subjects')->orderBy('name', 'desc');
        return view('dashboard.lessons', compact( $user, $subjects, $lessons));
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
