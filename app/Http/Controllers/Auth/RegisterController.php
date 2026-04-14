<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'address'               => 'required|string|max:255',
            'gender'                => 'required|in:Male,Female',
            'password'              => 'required|min:8|confirmed',
        ]);


        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'address'  => $request->address,
            'gender'   => $request->gender,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/')->with('success', 'Registration successful. Please log in.');
    }
}
