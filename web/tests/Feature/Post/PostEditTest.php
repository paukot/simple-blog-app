<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

uses(RefreshDatabase::class);
uses(WithFaker::class);

test('test user can access own post edit page', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user);
    $response = $this->get('/posts/' . $post->id . '/edit');

    $response->assertStatus(200);
    $response->assertViewIs('posts.edit');
});

test('test unauthorized user cannot access other user post edit page', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $unauthorizedUser = User::factory()->create();

    $this->actingAs($unauthorizedUser);
    $response = $this->get('/posts/' . $post->id . '/edit');

    $response->assertStatus(403);
});

test('test user can update a post', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $title = fake()->sentence;
    $content = fake()->paragraphs(3, true);

    $this->actingAs($user);
    $response = $this->put('/posts/' . $post->id, [
        'title' => $title,
        'content' => $content,
    ]);

    $response->assertRedirect('/posts');
    $this->assertDatabaseHas('posts', [
        'title' => $title,
    ]);
});

test('test unauthorized user cannot update other user post', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $unauthorizedUser = User::factory()->create();

    $title = fake()->sentence();

    $this->actingAs($unauthorizedUser);
    $response = $this->put('/posts/' . $post->id, [
        'title' => $title,
        'content' => fake()->paragraphs(3, true),
    ]);

    $response->assertStatus(403);
    $this->assertDatabaseMissing('posts', [
        'title' => $title,
    ]);
});

test('test guest cannot update posts', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $title = fake()->sentence();

    $response = $this->put('/posts/' . $post->id, [
        'title' => $title,
        'content' => fake()->paragraphs(3, true),
    ]);

    $response->assertRedirect('/login');
    $this->assertDatabaseMissing('posts', [
        'title' => $title,
    ]);
});
