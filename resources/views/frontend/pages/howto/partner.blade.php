@extends('frontend.layout.layout')
@section('content')
<div id="Content-Container">
    <div id="Content-Main">
        <div class="table-div">
            <div id="Content" class="table-cell">
                <article class="textMain ">
                    <h1>Partner with us</h1>
                    <div class="partner-with-us">
                        <div class="norml-buttn">
                            <a href="{{ route('login') }}">APPLY  NOW</a>
                        </div>
                    </div>

                    <ul class="partner-us-grid">
                        <li>
                            <span>1. APPLY </span>
                            We Unite 91 will review your application and in case of positive outcome select you as a partner
                        </li>
                        <li>
                            <span>2. REFER </span>
                            Introduce clients that are looking to fundraise to  <br/><logoStyle class="font91-min">We Unite<logoStyle91>91</logoStyle91></logoStyle>
                        </li>
                        <li>
                            <span>3. EARN</span>
                            Receive the commission / funding success fee after successful completion of the investment pitch of your referred Fund Raiser or Investor
                        </li>
                    </ul>



                </article>
            </div>
        </div>
    </div>	
</div>	
@endsection