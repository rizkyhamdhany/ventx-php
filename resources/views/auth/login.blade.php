@extends('layouts.login')
@section('content')
    <div class="content">
        <form class="login-form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-title">
                <span class="form-title">Welcome.</span>
                <span class="form-subtitle">Please login.</span>
            </div>
            <div class="alert alert-danger alert-danger-global display-hide">
                <button class="close" data-close="alert"></button>
                <span> Enter any email and password. </span>
            </div>
            <div class="alert alert-danger{{ $errors->has('email') ? '' : ' display-hide' }}">
                <button class="close" data-close="alert"></button>
                <span> Please enter an valid email. </span>
            </div>
            <div class="alert alert-danger{{ $errors->has('password') ? '' : ' display-hide' }}">
                <button class="close" data-close="alert"></button>
                <span> Please enter an valid password. </span>
            </div>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <input class="form-control form-control-solid placeholder-no-fix" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <input  class="form-control form-control-solid placeholder-no-fix" id="password" type="password" class="form-control" name="password" placeholder="password" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn red btn-block uppercase">Login</button>
            </div>
            <div class="form-actions">
                <div class="pull-left">
                    <label class="rememberme mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        <span></span>
                    </label>
                </div>
                <div class="pull-right forget-password-block">
                    <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                </div>
            </div>
        </form>
        <!-- END LOGIN FORM -->
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <form class="forget-form" action="index.html" method="post">
            <div class="form-title">
                <span class="form-title">Forget Password ?</span>
                <span class="form-subtitle">Enter your e-mail to reset it.</span>
            </div>
            <div class="form-group">
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email"
                       name="email"/></div>
            <div class="form-actions">
                <button type="button" id="back-btn" class="btn btn-default">Back</button>
                <button type="submit" class="btn btn-primary uppercase pull-right">Submit</button>
            </div>
        </form>
    <!-- END FORGOT PASSWORD FORM -->
    </div>
@endsection