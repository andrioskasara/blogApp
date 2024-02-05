<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);
        $comment = new Comment();
        $comment->on_post = $request->input('post_id');
        $comment->from_user = Auth::id();
        $comment->body = $request->input('body');
        $comment->save();
        return redirect()->route('post-show', ['slug' => $request->input('post_slug')]);

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
