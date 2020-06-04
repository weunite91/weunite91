@extends('frontend.layout.layout')
@php

$items = Session::get('logindata');

if($plan == 'free'){
    $amount = '0';
}
if($plan == 'treasure'){
    $amount = '5000';
}
if($plan == 'gilded'){
    $amount = '10000';
}
if($plan == 'platinum'){
    $amount = '15000';
}
if($plan == 'preferred'){
    $amount = '20000';
}
if($plan == 'royal'){
    $amount = '50000';
}
@endphp
@section('content')
<div class="forms">
    <div class="contact-form">	
        <div class="formtitle"><center>Pay Now</center></div>

        <form action="" method="post" id="payuForm" name="payuForm">
            {{ csrf_field() }}
            <div class="block-area ">
                <input type="hidden" name="key" value="" />
                <input type="hidden" name="hash" value=""/>
                <input type="hidden" name="txnid" value="" />
                <input type="hidden" name="planname" value="{{ ucfirst($plan) }}" />
                <input type="hidden" name="userid" value="{{ $items[0]['id'] }}" />
                <input type="hidden" name="hiamount" value="{{ $amount }}" />
            </div>
            <div class="inline-input" style="width: 100%;">
                <label>Plan</label>
                <input type="text" name="plan" id="plan"  readonly maxlength="120"   value="{{ ucfirst($plan) }}"/>
            </div>
            
            
            <div class="inline-input" style="width: 100%;">
                <label>First Name</label>
                <input type="text" name="firstname" id="firstname" readonly  maxlength="120"   value="{{ $items[0]['firstname']}}"/>
            </div>
            
            <div class="inline-input" style="width: 100%;">
                <label>Last Name</label>
                <input type="text" name="lname" id="lname"  maxlength="120" readonly   value="{{ $items[0]['lastname'] }}"/>
            </div>
            
            <div class="inline-input" style="width: 100%;">
               <label>Email</label>
                <input type="text" name="email" id="email"  maxlength="120"   value="{{ $items[0]['email'] }}"/>
            </div>

            <div class="inline-input" style="width: 100%;">
                <label>Phone Number</label>
                <input type="text" name="phone" id="phone"    value="{{ $phonenumber[0]->number }}">
            </div>
            
            <div class="inline-input" style="width: 100%;">
                <label>Amount (INR) </label>
                <input type="text" name="amount" id="amount"  readonly  value="{{ $amount }}"/>
            </div>
            <input type="hidden" name="day" value="{{ $day }}"/>
            @if($plan == 'free')
                <div class="inline-input submit-reset">
                    <center>
                        <a href="{{ route('fund-raiser-dashborad') }}">
                            <input type="submit" value="Continue">
                        </a>
                    </center>
                </div>
            @else
                <div class="inline-input submit-reset">
                    <center>
                        <input type="submit" value="Pay Now">
                    </center>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
