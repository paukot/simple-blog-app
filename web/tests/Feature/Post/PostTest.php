<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('test user can access posts index page', function () {
    $users = User::factory()->create();
    Post::factory()
        ->count(3)
        ->create(['user_id' => $users->id]);

    $response = $this->get('/posts');

    $response->assertStatus(200);
    $response->assertViewIs('posts.index');
});

test('test user can access empty posts index page', function () {
    $response = $this->get('/posts');

    $response->assertStatus(200);
    $response->assertViewIs('posts.index');
});

test('test user can access posts show page', function () {
    $users = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $users->id]);

    $response = $this->get('/posts/' . $post->id);

    $response->assertStatus(200);
    $response->assertViewIs('posts.show');
    $response->assertViewHas('post', $post);
});

test('test user can delete a post', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user);
    $response = $this->delete('/posts/' . $post->id);

    $response->assertRedirect('/posts');
    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
    ]);
});

test('test unauthorized user can delete other users post', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $unauthorizedUser = User::factory()->create();

    $this->actingAs($unauthorizedUser);
    $response = $this->delete('/posts/' . $post->id);

    $response->assertStatus(403);
    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
    ]);
});

test('test guest cannot delete posts', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $response = $this->delete('/posts/' . $post->id);

    $response->assertRedirect('/login');
    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
    ]);
});
