<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    public function __constructor()
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post, Request $request)
    {

        if ($post->likedBy($request->user())) {
            return back();
        }
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        if(!$post->likes()->onlyTrashed()->where(['user_id', $request->user()->id])->count()){
            //send email
            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        }

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        //likes table where post id is correct and user id is for this user
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}
