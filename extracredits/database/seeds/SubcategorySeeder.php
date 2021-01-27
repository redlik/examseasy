<?php

use Illuminate\Database\Seeder;
use App\Subcategory;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Subcategory::class, 50)->create();
    }
}
