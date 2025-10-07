<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

uses(RefreshDatabase::class);
uses(WithFaker::class);

test('test user can access posts create page', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/posts/create');

    $response->assertStatus(200);
    $response->assertViewIs('posts.create');
});

test('test guest is redirected to login page for create page', function () {
    $this->actingAsGuest();
    $response = $this->get('/posts/create');

    $response->assertRedirect('/login');
});

test('test user can create a post', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $title = fake()->sentence;
    $content = fake()->paragraphs(3, true);

    $response = $this->post('/posts', [
        'title' => $title,
        'content' => $content,
    ]);

    $response->assertRedirect('/posts');
    $this->assertDatabaseHas('posts', [
        'title' => $title,
    ]);
});

test('test guest cannot create a post', function () {
    $title = fake()->sentence;
    $content = fake()->paragraphs(3, true);

    $response = $this->post('/posts', [
        'title' => $title,
        'content' => $content,
    ]);

    $response->assertRedirect('/login');
    $this->assertDatabaseMissing('posts', [
        'title' => $title,
    ]);
});
