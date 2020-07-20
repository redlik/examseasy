<?php

namespace App\Http\Controllers;
use App\Subject;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home() {
        $subjects = Subject::all();
        return view('index', ['subjects' => $subjects]);
    }
}
