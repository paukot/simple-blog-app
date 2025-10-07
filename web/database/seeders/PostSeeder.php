<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();

        Post::factory()
            ->count(1000)
            ->create([
                'user_id' => fn() => $users[array_rand($users)],
            ]);
    }
}
