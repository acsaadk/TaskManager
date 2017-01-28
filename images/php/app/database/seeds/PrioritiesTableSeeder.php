<?php

use Illuminate\Database\Seeder;
use App\Priority;

class PrioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Priority::create([
          'name' => 'High'
        ]);
        Priority::create([
          'name' => 'Medium'
        ]);
        Priority::create([
          'name' => 'Low'
        ]);
    }
}
