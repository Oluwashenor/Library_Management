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
                <figure><img src="{{ asset('auth/images/signin-image.jpg') }}" alt="sign up image"></figure>
                <a href="/register" class="signup-image-link">Create an account</a>
            </div>

            <div class="signin-form">
                <h2 class="form-title">Reset your password</h2>
                <form method="POST" action="/updatePassword" class="register-form" id="login-form">
                    @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="email" hidden id="your_email" value="{{$email}}" />
                    </div>
                    <div class="form-group">
                        <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="your_pass" placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password_confirmation" id="your_pass" placeholder="Password" />
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                    </div>
                </form>
                <div class="social-login">
                    <a href="/forgotpassword" class="signup-image-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection