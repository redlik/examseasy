<?php

use Illuminate\Database\Seeder;
use App\Credit;
class CreditsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Credit::create(['number_of_credits' => 60, 'user_id' => 1]);
    }
}
