<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Level::truncate();

        Level::create(['level_name' => 'Leaving Cert', 'level_slug' => 'leaving-cert']);
        Level::create(['level_name' => 'Junior Cert', 'level_slug' => 'junior-cert']);
    }
}
