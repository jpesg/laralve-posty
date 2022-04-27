<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

//php artisan make:model Post -m -f
class PostController extends Controller
{
    public function index()
    {
        $post = Post::paginate(2);

        return view('posts.index', [
            'posts' => $post
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        /*Post::create([
            'user_id' => auth()->id(),
            'body' => $request->body
        ]);*/

        /*$request->user()->posts()->create([
            'body' => $request->body
        ]);*/

        $request->user()->posts()->create($request->only('body'));

        return redirect()->back();


    }
}
