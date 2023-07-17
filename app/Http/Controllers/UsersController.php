<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        $role = 'student';
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'person_id' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::where('email', $request['email'])->first();
        if ($user != null) {
            toast('E-Mail already exist', 'info');
            return redirect('/register');
        }
        $emails_for_admins = array("adeshiname@gmail.com");
        if (in_array($validatedData['email'], $emails_for_admins)) {
            $role = 'admin';
        }
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'role' => $role,
            'person_id' => $validatedData['person_id'],
            'token' => '',
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
            return redirect('/books');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function forgotpassword(Request $request)
    {
        return view('forgotpassword');
    }

    public function forgot_password(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        if ($user != null) {
            $token = $this->sendForgotPasswordEmail($request['email']);
            $user->token = $token;
            $user->save();
            toast('Please check your email for Verification', 'info');
            return redirect('/login');
        }
        toast('E-mail is Invalid', 'info');
        return redirect('/register');
    }

    public function sendForgotPasswordEmail($email)
    {
        // Generate confirmation link
        $token = Str::random(64); // Generate a random token
        $confirmationLink = route('passwordReset', ['token' => $token]); // Generate the confirmation link using a named route

        Mail::to($email)->send(new ForgotPassword($confirmationLink));
        return $token;
    }

    public function passwordReset($token)
    {
        $user = User::where('token', $token)->first();
        if ($user != null) {
            $email = $user->email;
            return view('passwordReset', compact('email'));
        }
        return redirect('/');
    }

    public function updatePassword(Request $request)
    {

        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::where('email', $validatedData['email'])->first();
        if ($user != null) {
            $user->password = Hash::make($validatedData['password']);
            $user->save();
            toast('Password Updated Successfully', 'success');
            return redirect('/login');
        }
        toast('Something went wrong', 'alert');
        return redirect('/');
    }
}
