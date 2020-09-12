<?php

namespace App\Http\Controllers;
use App\Subject;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use DB;

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
        $subcategory->order_position = $request->get('subcategory_order_position');
        $subcategory->save();

        return redirect()->back();
    }

    public function update(Request $request) {
        $subcategory = Subcategory::find($request->input('editSubcategoryId'));
        $subcategory->name = $request->input('name');
        $subcategory->order_position = (int)$request->get('subcategory_order_position');

        $subcategory->save();

        return redirect()->back();

    }

    public function destroy($category)
    {
        $subcategory = Subcategory::find($category);
        $subcategory->delete();

        return redirect()->back();
    }

    public function getTopic($subcategory_id) {
        echo json_encode(DB::table('topics')->where('subcategory_id', $subcategory_id)->get());
    }
}
