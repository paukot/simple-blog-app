<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();
        $postIds = Post::pluck('id')->toArray();

        foreach ($postIds as $postId) {
            Comment::factory()
                ->count(random_int(1, 5))
                ->create([
                    'post_id' => $postId,
                    'user_id' => fn() => $users[array_rand($users)],
                ]);
        }
    }
}
