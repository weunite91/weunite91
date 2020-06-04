@extends('backend.layout.loginlayout')
@section('content')
<div class="limiter">
    <div class="container-login100 page-background">
        <div class="wrap-login100">
            <form class="login100-form " method="post"   id="adminresetpassword">
                {{ csrf_field() }}
                <span class="login100-form-logo">
                    <i class="zmdi zmdi-flower"></i>
                </span>
                <span class="login100-form-title p-b-34 p-t-27">
                    Log in
                </span>
                @if (session('session_error'))
                <div class=" alert-danger">
                    {{ session('session_error') }}
                </div>
                @endif
               <input type="hidden" name="editid" value="{{ $details[0]->id }}">
                                        <input type="hidden" name="tokenid" value="{{ $details[0]->tokenid }}">
                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="password" id="password" placeholder="Password">
                    <span  data-placeholder="&#xf191;"></span>
                </div>
                
                 <div class="wrap-input100 validate-input" data-validate = "Enter confirm new password">
                    <input class="input100" type="password" name="cpassword" id="cpassword" placeholder="Confirm new password">
                    <span  data-placeholder="&#xf207;"></span>
                </div>
                
                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">Reset password</button>
                </div><br>
                
                
            </form>
        </div>
    </div>
</div>
@endsection