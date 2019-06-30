<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Gym;

class GymsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $gyms = factory(Gym::class, 10)->create();
    }
}
