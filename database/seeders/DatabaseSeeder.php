<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Post::truncate();
        \App\Models\Category::truncate();
        \App\Models\User::truncate();
        \App\Models\User::factory()->create(
            [
                'name' => Config::get("admin.name"),
                "is_admin" => true,
                'email' => Config::get("admin.email"),
                'email_verified_at' => now(),
                'password' => Hash::make(Config::get("admin.password")),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,
            ]
        );
        \App\Models\Category::factory(5)->create();
        \App\Models\Post::factory(100)->create();
    }
}
