<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user' => fn($query) => $query->select('id', 'name')])
            ->withCount('comments')
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        abort_if(auth()->user()->cannot('create', Post::class), 403);

        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        Post::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return to_route('posts.index')
            ->with('message', __('Post created successfully.'));
    }

    public function show(Post $post)
    {
        $post->load(['user' => fn($query) => $query->select('id', 'name')]);

        $comments = $post->comments()
            ->with(['user' => fn($query) => $query->select('id', 'name')])
            ->latest()
            ->paginate(10);

        return view('posts.show', compact('post', 'comments'));
    }

    public function edit(Post $post)
    {
        abort_if(auth()->user()->cannot('update', $post), 403);

        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        abort_if(auth()->user()->cannot('update', $post), 403);

        $post->update($request->validated());

        return to_route('posts.index')
            ->with('message', __('Post updated successfully.'));
    }

    public function destroy(Post $post)
    {
        abort_if(auth()->user()->cannot('update', $post), 403);

        $post->delete();

        return to_route('posts.index')
            ->with('message', __('Post deleted successfully.'));
    }
}
