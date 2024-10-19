<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(app()->environment() !== 'production') {
            User::create([
               "name" => "Manga Admin",
               "password" => bcrypt("123456"),
                "email" => "test@test.com",
                "email_verified_at" => now(),
                "remember_token" => Str::random(9),
            ]);
        }
    }
}
