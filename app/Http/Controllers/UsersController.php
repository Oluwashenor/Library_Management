<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        $role = 'user';
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::where('email', $request['email'])->first();
        if ($user != null) {
            toast('E-Mail already exist', 'info');
            return redirect('/register');
        }
        $emails_for_admins = array("adeshiname@gmail.com", "elfaithful@gmail.com");
        if (in_array($validatedData['email'], $emails_for_admins)) {
            $role = 'admin';
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'role' => $role
        ]);
        $user->save();
        toast('Account Created, Please Proceed to Login', 'info');
        return redirect('/login');
    }

    public function  login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            if (auth()->user()->role == 'admin') {
                return redirect('/admin');
            } else {
                return redirect('/home');
            }
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
