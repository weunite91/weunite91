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
				<th>Free</th>
				<th>Treasure<br/><span> <curreny><exchange>INR</exchange> <exvalue>5,000</exvalue></curreny></span></th>
				<th>Gilded<br/><span><curreny><exchange>INR</exchange> <exvalue>10,000</exvalue></curreny></span></th>
				<th class="best-buy">Platinum<br/><span><curreny><exchange>INR</exchange> <exvalue>15,000</exvalue></curreny></span></th>
				<th>Preferred<br/><span><curreny><exchange>INR</exchange> <exvalue>20,000</exvalue></curreny></span></th>
				<th>Royal<br/><span><curreny><exchange>INR</exchange> <exvalue>50,000</exvalue></curreny></span></th>
				</tr>
			</thead>
			<tbody>

			<tr>
				<td>Investors / Buyers connecting to you</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
			</tr>
			<tr>
				<td>Posting of our Pitch Deck in Active Pitch Deck </td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
			</tr>
			<tr>
				<td>Posting of our Pitch Deck in Live Pitch Deck  </td>
				<td class="ticker">-</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
			</tr>



			<tr>
				<td>Professional Profile with dashboard</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
			</tr>
			<tr>
				<td>Exclusive Introduction of your profile to investors (via Email)</td>
				<td class="ticker">-</td>
				<td class="ticker">100</td>
				<td class="ticker">500</td>
				<td class="ticker">2000</td>
				<td class="ticker">Un Limited</td>
				<td class="ticker">Un Limited</td>
			</tr>
			<tr>
				<td>Placement in popular pitch for </td>
				<td class="ticker">-</td>
				<td class="ticker">15 days</td>
				<td class="ticker">30 days</td>
				<td class="ticker">45 days</td>
				<td class="ticker">60 days</td>
				<td class="ticker">60 days</td>
			</tr>

			<tr>
				<td>Free Upgradation after 30 days </td>
				<td class="ticker">-</td>
				<td class="ticker">-</td>
				<td class="ticker">-</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
				<td class="ticker">-</td>
			</tr>
			<tr>
				<td>Your Pitch on the top page list</td>
				<td class="ticker">-</td>
				<td class="ticker">-</td>
				<td class="ticker">-</td>
				<td class="ticker">-</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
			</tr>
			<tr>
				<td>Branding tag</td>
				<td class="ticker">-</td>
				<td class="ticker">-</td>
				<td class="ticker">-</td>
				<td class="ticker">-</td>
				<td class="ticker">Yes</td>
				<td class="ticker">Yes</td>
			</tr>
			<tr>
				<td>Profile in home page banner for 15 days</td>
				<td class="ticker">-</td>
				<td class="ticker">-</td>
				<td class="ticker">-</td>
				<td class="ticker">-</td>
				<td class="ticker">-</td>
				<td class="ticker">Yes</td>
			</tr>
			<tr class="select-btn">
				<td></td>
				<td><a href="{{ route("payment","free") }}" class="pack">Select</a></td>
				<td>
					<a href="{{ route("payment","treasure") }}" class="pack" >Select</a>
			   	</td>
				<td>
				    <a href="{{ route("payment","gilded") }}" class="pack" >Select</a>
			   	</td>
				<td><a href="{{ route("payment","platinum") }}" class="pack" >Select</a></td>
				<td><a href="{{ route("payment","preferred") }}" class="pack" >Select</a></td>
				<td><a href="{{ route("payment","royal") }}" class="pack" >Select</a></td>
			</tr>
			</tbody>
			</table>

		</div>


		<div class="row" style="margin:10px 10px !important;background-color:#ccc;border-radius:10px !important" >
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
