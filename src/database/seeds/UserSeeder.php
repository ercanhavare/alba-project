<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Ercan",
            "surname" => "Havare",
            "email" => "admin@test.com",
            "mobile" => "05001234567890",
            "password" => Hash::make("password"),
            "role_id" => 1
        ]);

        User::create([
            "name" => "Member",
            "surname" => "Member",
            "email" => "member@test.com",
            "mobile" => "05301234567890",
            "password" => Hash::make("password"),
            "role_id" => 2
        ]);
    }
}
