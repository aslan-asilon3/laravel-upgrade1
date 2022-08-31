<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{

    
    public function run()
    {
        $admin = User::create([
            'name' => 'aslanadmin',
            'email' => 'aslanadmin@gmail.com',
            'password' => bcrypt('aslanadmin'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'aslanuser',
            'email' => 'aslanuser@gmail.com',
            'password' => bcrypt('aslanuser'),
        ]);

        $user->assignRole('user');
    }
}
