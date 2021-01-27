<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LevelsTableSeeder::class);
        $this->call(SubjectsTableSeed::class);
        $this->call(PermissionsSeeder::class);
        $this->call(SubcategorySeeder::class);
        $this->call(TopicSeeder::class);
    }
}
