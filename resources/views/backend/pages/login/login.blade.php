@extends('backend.layout.loginlayout')
@section('content')
<div class="limiter">
    <div class="container-login100 page-background">
        <div class="wrap-login100">
            <form class="login100-form " method="post"  action="{{ route('admin') }}" id="loginform">
                {{ csrf_field() }}
                <span class="login100-form-logo">
                     <img alt=""  src="{{ asset('public/frontend/image/united-91.jpg') }}">
                </span>
                <span class="login100-form-title p-b-34 p-t-27">
                    Log in
                </span>
                @if (session('session_error'))
                <div class=" alert-danger">
                    {{ session('session_error') }}
                </div>
                @endif
                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span  data-placeholder="&#xf207;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span  data-placeholder="&#xf191;"></span>
                </div>
                
                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">Login</button>
                </div><br>
                <div class="container-login100-form-btn">
                    <a href="{{ route('admin-forgot-password') }}" style="color: white">Forgot Password</a>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection