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

                                    <h2>&nbsp;</h2>
                                    <p>Hello {{ $details[0]->firstname }} {{ $details[0]->lastname }}</p>
                                    <p>Please update your password</p>


                                </div>
                                <div class="table-cell form-r">
                                    @if(Session::has('success')) <div class=""><center><span class="alert alert-success"><b>{{ Session::get('success') }}</b></span></center></div> @endif

                                    <h2>Update Password</h2>
                                    <form method="post" id="updatepassword" >
                                        @csrf
                                        
                                        <input type="hidden" name="editid" value="{{ $details[0]->id }}">
                                        <input type="hidden" name="tokenid" value="{{ $details[0]->tokenid }}">
                                        <div class="form-group" style="widows: 100%">
                                            <label class="password"></label>
                                            <input class="form-control" type="password" id="newpassword" name="password"  placeholder="New password" >
                                        </div>
                                        <div class="form-group">
                                            <label class="password"></label>
                                            <input class="form-control" type="password" name="confirmpassword"  placeholder="Confirm password" >
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
