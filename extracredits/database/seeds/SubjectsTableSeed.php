<?php

use Illuminate\Database\Seeder;
use App\Subject;

class SubjectsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::truncate();

        Subject::create(['name' => 'irish']);
        Subject::create(['name' => 'english']);
        Subject::create(['name' => 'history']);
        Subject::create(['name' => 'geography']);
        Subject::create(['name' => 'biology']);
        Subject::create(['name' => 'accounting']);
        Subject::create(['name' => 'business']);
        Subject::create(['name' => 'economics']);
        Subject::create(['name' => 'construction']);


    }
}
