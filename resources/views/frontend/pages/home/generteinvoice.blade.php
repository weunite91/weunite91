@extends('frontend.layout.layout')
@php

$items = Session::get('logindata');
@endphp
@section('content')
<div class="forms">
        <div class="contact-form">	
            <div class="formtitle">
                <center>Generate Invoice</center>
            </div>
<form method="post" action="" enctype="multipart/form-data" id="myform">{{ csrf_field() }}
                <div class="inline-input">
                    <input type="text" name="firstname" id="firstname" placeholder="First Name *" maxlength="20" value="{{ $userDetails[0]->firstname != null ? $userDetails[0]->firstname : '' }}"/>
                </div>
                <div class="inline-input">
                    <input type="text" name="lastname" id="lastname" placeholder="Last Name *" value="{{ $userDetails[0]->lastname != null ? $userDetails[0]->lastname : '' }}"  maxlength="20"  />
                </div>
                <div class="inline-input">
                    <input type="text" name="company"   maxlength="40" placeholder="Company Name" value="{{ $userDetails[0]->companyname != null ? $userDetails[0]->companyname : '' }}"/>
                </div>
                <div class="inline-input ">

<input type="text" value="{{ $userDetails[0]->number != null ? $userDetails[0]->number : '' }}" name="mnumber" minlength="8" maxlength="12" id="mnumber" placeholder="Mobile Number *" class="valid " onkeypress="return isNumber(event);" aria-invalid="false">
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

                <div class="inline-input ">
                   <input type="text" value="{{ $userDetails[0]->gst != null ? $userDetails[0]->gst : '' }}" name="gst" minlength="8" maxlength="16" id="gst" placeholder="GST Number *" class="valid "  aria-invalid="false">
                </div>
                <div class="block-area">
                        Please confirm your details before accessing your invoice.
                        You will not be allowed to change the invoice once viewed.

                </div>
                <div class="inline-input submit-reset">
                    <center>
                        <input type="reset" style="width: 180px" class="reset-btn" />
                        <input type="submit" style="width: 180px" class="submitbtn" name="submit_now" value="Generate Invoice"/>
                    </center>
                </div>
                
</form>
</div>
</div>
@endsection