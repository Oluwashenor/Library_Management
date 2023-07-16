@extends('layouts.auth-layout')

<?php
$title = "Login";
?>

@section('content')

<!-- Sign in  Form -->
<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{ asset('auth/images/signin-image.jpg') }}" alt="sing up image"></figure>
                <a href="/login" class="signup-image-link">Back to Login</a>
            </div>

            <div class="signin-form">
                <h2 class="form-title">Forgot Password</h2>
                <form method="POST" action="/forgot_password" class="register-form" id="login-form">
                    @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="email" id="your_email" placeholder="Your E-mail" />
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Request Password Change" />
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>


@endsection