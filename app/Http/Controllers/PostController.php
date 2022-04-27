<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

//php artisan make:model Post -m -f
class PostController extends Controller
{
    public function index()
    {
        //$post = Post::orderBy('created_at', 'desc')->with(['user', 'likes'])->paginate(20);
        $post = Post::latest()->with(['user', 'likes'])->paginate(20);

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

    public function destroy(Post $post, Request $request)
    {
        /*if ($post->ownedBy($request->user())) {
            $post->delete();
        }*/

        return back();
    }
}
