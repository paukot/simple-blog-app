<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('test user can post comments', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $comment = fake()->paragraphs(3, true);

    $this->actingAs($user);
    $response = $this->post('/posts/' . $post->id . '/comments', [
        'comment' => $comment,
    ]);

    $response->assertRedirect('/posts/' . $post->id);
    $this->assertDatabaseHas('comments', [
        'post_id' => $post->id,
        'user_id' => $user->id,
        'comment' => $comment,
    ]);
});

test('test guest cannot post comments', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $comment = fake()->paragraphs(3, true);

    $response = $this->post('/posts/' . $post->id . '/comments', [
        'comment' => $comment,
    ]);

    $response->assertRedirect('/login');
    $this->assertDatabaseMissing('comments', [
        'post_id' => $post->id,
        'comment' => $comment,
    ]);
});

test('test user can delete comments', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $comment = Comment::factory()->create([
        'post_id' => $post->id,
        'user_id' => $user->id,
    ]);

    $this->actingAs($user);
    $response = $this->delete('/posts/' . $post->id . '/comments/' . $comment->id);

    $response->assertRedirect('/posts/' . $post->id);
    $this->assertDatabaseMissing('comments', [
        'id' => $comment->id,
    ]);
});

test('test unauthorized user cannot delete comments', function () {
    $user = User::factory()->create();
    $unauthorizedUser = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $comment = Comment::factory()->create([
        'post_id' => $post->id,
        'user_id' => $user->id,
    ]);

    $this->actingAs($unauthorizedUser);
    $response = $this->delete('/posts/' . $post->id . '/comments/' . $comment->id);

    $response->assertStatus(403);
    $this->assertDatabaseHas('comments', [
        'id' => $comment->id,
    ]);
});

test('test guest cannot delete comments', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $comment = Comment::factory()->create([
        'post_id' => $post->id,
        'user_id' => $user->id,
    ]);

    $response = $this->delete('/posts/' . $post->id . '/comments/' . $comment->id);

    $response->assertRedirect('/login');
    $this->assertDatabaseHas('comments', [
        'id' => $comment->id,
    ]);
});