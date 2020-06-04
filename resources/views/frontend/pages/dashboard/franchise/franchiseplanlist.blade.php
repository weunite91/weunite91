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
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>{{ Session::get('success') }} !</strong>
        </div>
        @endif
        @include('frontend.include.profiledetails')

        <div class="progressbar profile-progress">
            <div class="progressbar-intra" data-width="70%">
                <span><b></b></span>
            </div>
        </div>
       
        @if($profiledata[0]->paymnet_status == 'S')
        <div class="">
            <center>
                <span class="error">Note : If Choose new plan then it's automatically override with new plan.</span><br>
                
                <a href="{{ route('pitch-detail',$profiledata[0]->id) }}">Go with your current plan</a>
                
            </center>
            
        </div>
        @endif
        <div class="plans">
			<div style="overflow-x:auto;">
				<table>
			<thead>
			<tr>
				<th></th>
				<th style='text-align:center !important'>Basic <br/>INR 3,500 </th>
				<th style='text-align:center !important'>Platinum<br/>INR 12,000  </th>
				</tr>
			</thead>
			<tbody>
			
			<tr>
				<td>Investors/Franchises connecting to you</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
			
			</tr>
			<tr>
				<td>Posting of our Pitch Deck in Active Pitch Deck </td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				
			</tr>
			<tr>
				<td>Posting of our Pitch Deck in Live Pitch Deck  </td>
				
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				
			</tr>
			
			
			
			<tr>
				<td>Professional Profile with dashboard</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				
			</tr>
			<tr>
				<td>Your Pitch on the top page list	</td>
				<td class="ticker">-</td>
				<td class="ticker">Yes</td>
				
			</tr>
			<tr>
				<td>Professional Email ID</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
			</tr>
			<tr>
				<td>Logo Presence in the Service/Product category </td>
				<td class="ticker">-</td>
				<td class="ticker">Yes</td>
			</tr>
			
			<tr class="select-btn">
				<td></td>
				<td><a class="pack basicanchor">View Basic Plans</a></td>
				<td>
					<a  class="pack platinumanchor" >View Platinum Plans</a>
			   	</td>
				
			</tr>
			</tbody>
			</table>
		
		</div>
		<div id="divBasic" style="display:none">
			<div style="text-align:center;font-weight:bold;margin-top:5px !important;margin-bottom:5px !important">Basic Plan Details</div>
		<table>
		<thead>
		<tr>
		<th style="text-align:center;">No. Of Months</th>
		<th style="text-align:center;">Per Month Price</th>
		<th style="text-align:center;">Total Price</th>
		<th></th>
		</tr>
		</thead>
		<tbody>
		@foreach($all_plan_list as $plan_rec)
		@if ($plan_rec->plan_type=='Basic')
		<tr class="select-btn">
		<td>{{$plan_rec->plan_name}}</td>
		<td>{{indian_money_format($plan_rec->plan_amount/$plan_rec->plan_duration)}} per Month</td>
		<td>{{indian_money_format($plan_rec->plan_amount)}}</td>
		<td class="pack"><a href="franchise-payment/{{$plan_rec->plan_id}}" > Select</a>
		</tr>
		@endif
		@endforeach
		</tbody>
		</table>
		</div>
		<div id="divPlatinum" style="display:none">
		<div style="text-align:center;font-weight:bold;margin-top:5px !important;margin-bottom:5px !important">Platinum Plan Details</div>
		
		<table>
		<thead>
		<tr>
		<th style="text-align:center;">No. Of Months</th>
		<th style="text-align:center;">Per Month Price</th>
		<th style="text-align:center;">Total Price</th>
		<th></th>
		</tr>
		</thead>
		<tbody>
		@foreach($all_plan_list as $plan_rec)
		@if ($plan_rec->plan_type=='Platinum')
		<tr class="select-btn">
		<td>{{$plan_rec->plan_name}}</td>
		<td>{{indian_money_format($plan_rec->plan_amount/$plan_rec->plan_duration)}} per Month</td>
		<td>{{indian_money_format($plan_rec->plan_amount)}}</td>
		<td class="pack"><a href="franchise-payment/{{$plan_rec->plan_id}}" > Select</a>

		</tr>
		@endif
		@endforeach
		</tbody>
		</table>
</div>

		<div class="row" style="display:none;margin:10px 10px !important;background-color:#ccc;border-radius:10px !important" >
			<div class="col-md-6 col-lg-6" style="padding-left:40%">
			 <input class="passcode-btn" style="border-radius: 10px !important;height:30px !important;width:100px !important" type="button" value="Passcode >" name="btnmainPasscode" id="btnmainPasscode" />
			</div>
			<div  class="col-md-6 col-lg-6" style="margin-bottom:10px !important;margin-top:10px !important;display:none" id="divPasscode" >
		Passcode: <input type="text" name="passcode" id="passcode" 
		placeholder="Enter Passcode here"
		style="margin-left:5px !important;margin-right:5px !important;" />
		<input  style="background-image: linear-gradient(to right top, #f9dc06, #fadf19, #fce225, #fde42f, #ffe737) !important;border-radius: 10px !important;height:30px;width:100px" type="button" value="Apply" name="btnPasscodeApply" id="btnPasscodeApply" />
		</div>
	</div>
		
		</div>
		
		
        


    </div>
	@include('frontend.include.popup')

   
@endsection
