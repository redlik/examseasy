<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::role('student')->select(['name', 'email'])->where('claim', 0)->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email'
        ];
    }
}
