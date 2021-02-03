<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;

class StudentController extends Controller
{
    public function studentsExport() {
        return Excel::download(new StudentsExport(), 'students.xlsx');
    }
}
