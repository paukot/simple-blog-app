<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('test user can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect('/');
    $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
});

test('test user can access register page', function () {
    $response = $this->get('/register');
    $response->assertStatus(200);
});

test('test authenticated user is redirected to home for register page', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/register');
    $response->assertRedirect('/');
});

test('test user can log in', function () {
    $password = 'password';
    $user = User::factory()->create(['password' => bcrypt($password)]);

    $response = $this->post('/authenticate', [
        'email' => $user->email,
        'password' => $password,
    ]);

    $response->assertRedirect('/');
    $this->assertAuthenticatedAs($user, 'web');
});

test('test user can access login page', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
});

test('test authenticated user is redirected to home for login page', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/login');
    $response->assertRedirect('/');
});

test('test user can log out', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/logout');
    $response->assertRedirect('/');
    $this->assertGuest();
});
