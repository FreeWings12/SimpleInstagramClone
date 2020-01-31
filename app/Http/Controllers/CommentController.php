<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Post $post)
    {
        return view('comments.create', compact('post'));
    }
    
    public function store(Post $post)
    {
        $data = $this->validateRequest();
        $data['post_id']  = $post->id;
        
        auth()->user()->comments()->create($data);
        
        return redirect($post->showPostPath());
    }

    public function edit(Post $post, Comment $comment)
    {
        return view('comments.edit', compact('post', 'comment'));
    }

    public function update(Post $post, Comment $comment)
    {
        $data = $this->validateRequest();
        $data['post_id']  = $post->id;
        $comment->update($data);
        return redirect($post->showPostPath());
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
        return redirect($post->showPostPath());
    }

    private function validateRequest()
    {
        return request()->validate([
            'comment' => 'required',
        ]);

    }
}
