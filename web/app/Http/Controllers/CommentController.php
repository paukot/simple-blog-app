<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post)
    {
        abort_if(auth()->user()->cannot('create', $post), 403);

        Comment::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        return to_route('posts.show', $post)
            ->with('message', __('Comment created successfully.'));
    }


    public function destroy(Post $post, Comment $comment)
    {
        abort_if(auth()->user()->cannot('update', $comment), 403);

        $comment->delete();

        return to_route('posts.show', $post)
            ->with('message', __('Comment deleted successfully.'));
    }
}
