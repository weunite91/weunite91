@extends('frontend.layout.layout')
@section('content')
<div id="Content-Container">
        <div id="Content-Main">
            <div class="table-div">
                <div id="Content" class="table-cell">
                    <article class="textMain ">


                        <div class="login-form">
                            <div class="table-div">
                                <div class="table-cell form-l">

                                    <h2>Message</h2>
                                    <p>Reset password link will send in your register email.
                                    </p>


                                </div>
                                <div class="table-cell form-r">
                                    @if(Session::has('success')) <div class=""><center><span class="alert alert-success"><b>{{ Session::get('success') }}</b></span></center></div> @endif

                                    <h2>Reset Password</h2>
                                    <form method="post" id="forgotpassword" >
                                        @csrf
                                        
                                        
                                        <div class="form-group">
                                            <label class="email"></label>
                                            <input class="form-control" type="email" name="email"  placeholder="Enter your register email" >
                                        </div>

                                        <div class="form-group full-blk">
                                            <input type="submit"  name="submit" class="submitbtnregister form-submit">
                                        </div>

                                    </form>
<!--                                    <a href="#">Resend Otp</a>-->


                                </div>

                            </div>
                        </div>




                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection
