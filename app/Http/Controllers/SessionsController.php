<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    //
    public function create(){
        return view('sessions.create');
    }

    public function store(){
        $attributes = request()->validate([
           'password' => 'required',
           'email' => 'required|email'
        ]);
        if (auth()->attempt($attributes)){
            session()->regenerate();

            return redirect('/')->with('success',"Welcome Back");
        }

        throw ValidationException::withMessages([
           'email' => 'You provided credentials could not be verified'
        ]);
    }

    public function destroy(){
        auth()->logout();
        return redirect('/')->with('success','Goodbye');
    }
}
