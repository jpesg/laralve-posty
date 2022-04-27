<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

//php artisan make:controller Auth\\RegisterController

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.register');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed', //looks for _confirmed

        ]);;//throw exception --> send errors to frontend

        //store user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        //sign user in
        auth()->attempt($request->only('email', 'password'));//returns User model
        //redirect
        return redirect()->route('dashboard');
    }

}
