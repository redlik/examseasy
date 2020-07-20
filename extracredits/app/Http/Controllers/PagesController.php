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
}
