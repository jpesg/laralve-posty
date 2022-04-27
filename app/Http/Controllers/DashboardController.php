<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
//php artisan make:mail PostLiked --markdown=emails.posts.post_liked
//php artisan make:migration add_soft_deletes_to_likes_table --table=likes
    //apply  middleware inside controller
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('dashboard');
    }
}
