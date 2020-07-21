<?php

namespace App\Http\Controllers;
use App\Subject;
use App\User;
use App\Lesson;
use Auth;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home() {
        $subjects = Subject::all();
        return view('index', ['subjects' => $subjects]);
    }

    public function dashboard() {
        $user = Auth::user();
        $lessons = Lesson::withCount('user')->get();
        $users = User::all();
        return view('dashboard', ['user' => $user, 'lessons'=> $lessons, 'users'=>$users]);
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
