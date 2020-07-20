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
        $lessons = Lesson::all();
        $users = User::all();
        return view('dashboard', ['user' => $user, 'lessons'=> $lessons, 'users'=>$users]);
    }
}
