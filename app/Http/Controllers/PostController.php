<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->latest()->get();
        return view('welcome')->with('posts', $posts);
    }

    public function my_posts()
    {
        $posts = Post::with('author')->where('author_id', Auth::id())->latest()->get();
        return view('dashboard')->with('posts', $posts);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->body = $request->input('body');
        $post->author_id = Auth::id();
        $post->active = 1;
        $post->save();

        return redirect()->route('dashboard');
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->first();
        $comments = Comment::where('on_post', $post->id)->latest()->get();
        return view('posts.show')->with('post', $post)->with('comments', $comments);
    }

    public function edit(Request $request, string $slug)
    {
        $post = Post::where('slug', $slug)->first();
        if ($post && Auth::id() == $post->author_id) {
            return view('posts.edit')->with('post', $post);
        } else {
            return redirect('/dashboard');
        }
    }

    public function update(Request $request)
    {
        $post = Post::where('slug', $request->input('slug'))->first();
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->slug = $request->input('body');
        $post->save();
        return redirect('/dashboard');
    }

    public function destroy(string $id)
    {
        //
    }
}
