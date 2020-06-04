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
                                    <p>A one time verification code has been sent to your email ID.
                                        Please enter the OTP to verify your email.
                                        @if (!empty($data))
                                        <div class="alert alert-success">
                                            {{$data['email']}}
                                        </div>
                                        @endif
                                    </p>



                                </div>
                                <div class="table-cell form-r">
                                    @if(Session::has('success')) <div class=""><center><span class="alert alert-success"><b>{{ Session::get('success') }}</b></span></center></div> @endif

                                    <h2>Verify OTP</h2>
                                    <form method="post" id="verifyaccount" >
                                        @csrf
                                        <div class="form-group full-blk checkbox-list">
                                        </div>
                                        <input type="hidden" name="email" value="{{ $email }}">
                                        <div class="form-group">
                                            <label class="name"></label>
                                            <input class="form-control" type="password" name="otp"  placeholder="Enter Otp" >
                                        </div>

                                        <div class="form-group full-blk">
                                            <input type="submit"  name="submit" class="submitbtn form-submit">
                                        </div>

                                    </form>
                                    <button type="button"  style="border: 1px solid transparent;background:transparent;color: #000 "class="btn btn-link resndotp" data-email="{{ $email }}">Resend OTP</button>
                                    <p style="color: #018aff ; font:300 13px/26px 'Montserrat'">
                                        Please check your SPAM / JUNK folder if you did not receive the OTP in you inbox
                                    </p>

                                </div>

                            </div>
                        </div>




                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection
