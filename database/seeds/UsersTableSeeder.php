<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Gym;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
            'name' => "Super Admin",
            'type' => 0,
            'email' => "super_admin@yahoo.com",
            'password' => Hash::make("secret"),
        ]);

        $admin_users = factory(User::class, 50)->create([
          'type' => 1,
          'gym_id' => factory(Gym::class),
        ]);

        $users = factory(User::class, 10)->create([
          'type' => 2,
        ]);
    }
}
