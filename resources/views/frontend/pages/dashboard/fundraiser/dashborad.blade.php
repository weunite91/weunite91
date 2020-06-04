@extends('frontend.layout.layout')
@php

$items = Session::get('logindata');
@endphp
@section('content')
<style>
    .alert {
        padding: 20px;
        background-color: #4CAF50;
        color: white;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
</style>
<!--#include file="includes/header.shtml"-->
<div class="main-container">
    @if(Session::has('success'))
    <div class="alert success">
        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
        <strong>{{ Session::get('success') }} !</strong>
    </div>
    @endif
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
                    $cnt=1;
                @endphp
                @foreach($investment_offerd as $key => $value)
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
        <div class="pull-right" style="margin-top: 11px">
            {{ $investment_offerd->links() }}
        </div>
    </div>

    <div class="progressbar profile-progress" style="margin-top: 70px">
        @if($profiledata[0]->max_investment > 0 && $profiledata[0]->max_investment !='')
        @php
        $width=($total_amount_fund*100)/$profiledata[0]->max_investment;
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
        <div class="progressbar-intra" data-width="{{round($width)}}">
            <span><b>{{ indian_money_format($total_amount_fund) }}</b><span><b>INR</span></b></span>
        </div>
    </div>

    <hr>


    <div class="forms">
        <div class="contact-form">
            <div class="formtitle">
                <center>Update Profile</center>
            </div>

            <ul class="steps-btn">
                <li class="active"><a href="{{ route('fund-raiser-dashborad') }}">Step 1</a></li>
                <li><a href="{{ route('fund-details') }}">Step 2</a></li>
                <li><a href="{{ route('planlist')}}">Step 3</a></li>
            </ul>

            <form method="post" action="" enctype="multipart/form-data" id="myform">{{ csrf_field() }}
                <div class="inline-input">
                    <input type="text" name="firstname" id="firstname" placeholder="First Name *" maxlength="20" value="{{ $userDetails[0]->firstname != null ? $userDetails[0]->firstname : '' }}"/>
                </div>
                <div class="inline-input">
                    <input type="text" name="lastname" id="lastname" placeholder="Last Name *" value="{{ $userDetails[0]->lastname != null ? $userDetails[0]->lastname : '' }}"  maxlength="20"  />
                </div>

                <div class="inline-input">
                    <select class="full-col" name="designation" id="designation">
                        <option value="">Designation *</option>
                        @foreach($designationlist as $key => $value)
                        <option value="{{ $value->de_id}}" {{ $userDetails[0]->designation != null && $userDetails[0]->designation == $value->de_id ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="inline-input">
                    <input type="email" name="email" id="email" placeholder="Email *" value="{{ $userDetails[0]->email != null ? $userDetails[0]->email : '' }}"/>
                </div>

                <div class="inline-input">
                    <input type="text" name="company"   maxlength="40" placeholder="Company Name" value="{{ $userDetails[0]->companyname != null ? $userDetails[0]->companyname : '' }}"/>
                </div>

                <div class="inline-input">
                    <input type="text" name="website" placeholder="Website" value="{{ $userDetails[0]->website != null ? $userDetails[0]->website : '' }}"/>
                </div>

                <div class="inline-input">

                    <input type="text" value="{{ $userDetails[0]->number != null ? $userDetails[0]->number : '' }}" name="mnumber" minlength="8" maxlength="12" id="mnumber" placeholder="Mobile Number *" class="valid " onkeypress="return isNumber(event);" aria-invalid="false">
                </div>

                <div class="inline-input ">

                    <input type="text" name="altnumber" id="altnumber"  maxlength="15"  minlength="8" placeholder="Phone Number *" value="{{ $userDetails[0]->phone_number != null ? $userDetails[0]->phone_number : '' }}" onkeypress="return isNumber(event);"/>
                </div>

                <div class="block-area" style="margin-left:10px ; padding: 0px;">
                    <textarea name="address" id="address" maxlength="250" placeholder="Address *" >{{ $userDetails[0]->address != null ? $userDetails[0]->address : '' }}</textarea>
                </div>

                <div class="inline-input">
                    <select class="full-col " id="country" name="country" >
                        <option value="" >Country *</option>
                        @foreach($countryname as $key => $value)
                        <option value="{{ $value['id'] }}" {{ $userDetails[0]->country != null && $userDetails[0]->country == $value['id'] ? 'selected="selected"' : '' }}>{{ $value['name'] }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="inline-input">
                    <select class="full-col state" id="state" name="state" >
                        <option value=""> State *</option>
                        @foreach($statelist as $key => $value)
                        <option value="{{ $value['id'] }}" {{ $userDetails[0]->state != null && $userDetails[0]->state == $value['id'] ? 'selected="selected"' : '' }}>{{ $value['name'] }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="inline-input">
                    <select class="full-col city" id="city" name="city">
                        <option value=""> City *</option>
                        @foreach($citylist as $key => $value)
                        <option value="{{ $value['id'] }}" {{ $userDetails[0]->city != null && $userDetails[0]->city == $value['id'] ? 'selected="selected"' : '' }}>{{ $value['name'] }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="inline-input">
                    <input type="text" value="{{ $userDetails[0]->pincode != null ? $userDetails[0]->pincode : '' }}" maxlength="12" name="pincode" id="pincode" placeholder="Pincode *" onkeypress="return isNumber(event);"/>
                </div>


                <div class="inline-input">
                    <select class="full-col" name="industry" id="industry">
                        <option value="">Industry *</option>
                        @foreach($industrylist as $key => $value)
                        <option value="{{ $value['id'] }}" {{ $userDetails[0]->industry != null && $userDetails[0]->industry == $value['id'] ? 'selected="selected"' : '' }}>{{ $value['industry'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="inline-input" style="display:none">
                    <input type="text" name="gst" value="{{ $userDetails[0]->gst != null ? $userDetails[0]->gst : '' }}" placeholder="GST Number" />
                </div>
                <div class="inline-input">
                    <input type="password" name="password" id="password" placeholder="New Password" value=""/>
                </div>
                <div class="inline-input">
                    <input type="password" value="" name="cpassword" id="cpassword" placeholder="Confirm Password" />
                </div>

                <div class="inline-input">
                    <center>
                        <input type="text" name="partnercode" placeholder="Enter Partner Code" value="{{ $userDetails[0]->partnercode != null ? $userDetails[0]->partnercode : '' }}" {{ $userDetails[0]->partnercode != null ? 'disabled="disabled"' : '' }}/>
                    </center>
                    <p>if you are referred by channel partner please enter reference code</p>
                </div>





                <div class="inline-input submit-reset">
                    <center>
                        <input type="reset" style="width: 180px" class="reset-btn" />
                        <input type="submit" style="width: 180px" class="submitbtn" name="submit_now" value="Update & Continue"/>
                    </center>
                </div>
            </form>
        </div>









        <div id="popupOTP" class="overlayPOP">
            <div class="popup popup-enquiry">
                <div class="popupTitle">Please enter the 6-digit verification code sent to registered email id.</div>
                <a class="close" href="#">&times;</a>
                <div id="form">
                    <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    <button class="btn btn-primary btn-embossed">Verify</button>
                </div>
                <a href="#" class="send-code-text">Send code again</a>
            </div>
        </div>






    </div>





</div>








<!--#include file="includes/footer.shtml"-->
@endsection
