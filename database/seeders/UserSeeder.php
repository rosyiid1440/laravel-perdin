<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user = new User;
       $user->name = "Admin";
       $user->username = "admin";
       $user->email = "admin@perdin.test";
       $user->password = Hash::make('admin');
       $user->role_id = 1;
       $user->save();
    }
}