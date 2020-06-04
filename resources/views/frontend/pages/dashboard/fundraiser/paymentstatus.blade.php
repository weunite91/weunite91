@extends('frontend.layout.layout')
@php

$items = Session::get('logindata');
@endphp
@section('content')
    <div class="main-container">
        @include('frontend.include.profiledetails')
            <div class="investment-summary responsive-table">
            <table>
                <thead>
                <tr>
                    <th scope="col" class="sr-th">SR. No</th>
                    <th scope="col">Investors</th>
                    <th scope="col">Investment Offered</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $totalamount=0;
                    $cnt=1;
                @endphp
                @foreach($investment_offerd as $key => $value)
                @php
                    $totalamount+=$value->ammount;
                @endphp
                <tr>
                    <td scope="row" data-label="SR. No">{{$cnt}}</td>
                    <td data-label="Investors">{{$value->profile_code}}</td>
                    <td data-label="Investment Offered">INR {{$value->ammount}}</td>
                </tr>
                @php
                    $cnt++;
                @endphp
               @endforeach
                </tbody>
            </table>
        </div>
        <div class="progressbar profile-progress">
            @if($profiledata[0]->max_investment > 0 && $profiledata[0]->max_investment !='')
                @php
                    $width=($totalamount*100)/$profiledata[0]->max_investment;
                @endphp
                @if($width <= 100)
                    @php $width=$width; @endphp
                @else
                    @php $width=100; @endphp
                @endif
            @else
                @php
                    $width=0;
                @endphp
            @endif
            <div class="progressbar-intra" data-width="{{round($width).'%'}}">
                <span><b></b></span>
            </div>
        </div>
    </div>
    <br><br>
    <section>
        <div id="Info-Grid">
            <div id="Info-Grid-Intra">
                <p class="main-text">Your profile successfully updated.<br/>After Approval by admin .it will display on live.</p>
                <center><a class="btn btn-circle" href="{{ route('fund-raiser-dashborad') }}">Go to dashboard</a></center>
            </div>
        </div>
<br><br>
        <div id="Quick-Links">
            <div id="Quick-Links-Intra">
                <div class="table-div ql-intra">
                    <div class="table-cell ql-l">
                        <div class="theme-L"></div>
                        <p>A Supporting hand in every stage<a href="#popup1">Ask Our Expert</a></p>
                        
                    </div>
                    <div class="table-cell ql-r">
                        <p>World's most trusted investment platform</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

<div id="popup1" class="overlayPOP">
    <div class="popup popup-enquiry">
        <div class="popupTitle">Get an professional advice</div>
        <a class="close" href="#">&times;</a>
        <div class="block-area">
            <label class="textcenter">
                <input type="checkbox" name="" value="" class="agree-box"> Prepare your financial &amp; financial offering
            </label>
        </div>
        <div class="block-area">
            <label class="textcenter">
                <input type="checkbox" name="" value="" class="agree-box"> Consulting a legal aspect of the deal
            </label>
        </div>
        <div class="block-area">
            <label class="textcenter">
                <input type="checkbox" name="" value="" class="agree-box"> Prepare your pitch deck
            </label>
        </div>
        <div class="block-area">
            <label class="textcenter">
                <input type="checkbox" name="" value="" class="agree-box"> Prepare your videos &amp; photos for your pitch deck
            </label>
        </div>
        <div class="inline-input ">
            <input type="text" name="firstname" placeholder="First Name *" />
        </div>
        <div class="inline-input ">
            <input type="number" name="lastname" placeholder="Mobile Number *" onkeypress="return isNumber(event);" />
        </div>
        <div class="inline-input ">
            <input type="email" name="email" placeholder="Email *" />
        </div>
        <div class="inline-input block-area">
            <textarea name="address" placeholder="Query/Feedback" maxlength="240"></textarea>
        </div>
        <div class="inline-input submit-reset">
            <input type="reset" class="reset-btn" />
            <input type="submit" value="Submit Now" />
        </div>
    </div>
</div>
@endsection
