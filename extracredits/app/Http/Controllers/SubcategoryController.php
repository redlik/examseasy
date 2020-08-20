<?php

namespace App\Http\Controllers;
use App\Subject;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function create() {
        $subjects = Subject::all();
        return view('subcategories.create', ['subjects' => $subjects]);
    }

    public function store(Request $request) {
        $subcategory = new Subcategory();
        $subcategory->name = $request->input('name');
        $subcategory->slug = Str::slug($request->input('name'), '-');
        $subcategory->subject_id = $request->get('subjectSelect');
        $subcategory->save();

        return redirect()->back();
    }
}
