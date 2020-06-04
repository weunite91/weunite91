@extends('backend.layout.layout')
@section('content')
@php


if($userdetails[0]->roles == "A"){
    $usertype = 'Admin';
}

if($userdetails[0]->roles == "S"){
    $usertype = 'Staff';
}


if($userdetails[0]->roles == "FR"){
    $usertype = 'Fund Raiser';
}


if($userdetails[0]->roles == "F"){
    $usertype = 'Franchise';
}

if($userdetails[0]->roles == "P"){
    $usertype = 'Partner';
}

if($userdetails[0]->roles == "I"){
    $usertype = 'Investor';
}

@endphp
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Investor Edit Details</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="{{ route("all-users") }}">All Users</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Investor Edit Details</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="profile-tab-box">
                            <div class="p-l-20">
                                <ul class="nav ">
                                    <li class="nav-item tab-all">
                                        <a class="nav-link active show" href="#tab1" data-toggle="tab">Investor Details</a>
                                    </li>  
                                                                                       
                                </ul>
                            </div>
                        </div>
                        <div class="white-box">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active fontawesome-demo" id="tab1">
                                    <div id="biography" >

                                        <div class="row profilecoderow">
                                            
                                            <div class="col-md-4 col-4 b-r"> 
                                                <strong>User Profile Code</strong>
                                                <br>
                                                <span class="label label-lg label-success lblprofilecode ">{{ $userdetails[0]->profile_code }}</span>
                                            </div>
                                            
                                            <div class="col-md-4 col-4 b-r "> <strong>User Type</strong>
                                                <br>
                                                <span class="label label-lg label-danger">{{ $usertype }}</span>
                                            </div>
                                            
                                            <div class="col-md-4 col-4 b-r "> <strong>User's Weunite91 Email</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->weunite_email }} </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="card-body " id="bar-parent1">
                                                <form method="post" id="editinvestordetail-form" action="{{ route('submit-investor-edit-admin', $user_id )}}" enctype="multipart/form-data">{{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                           <div class="form-group">
                                                                <label for="simpleFormEmail">First Name</label>
                                                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter user first name" value="{{ $userdetails[0]->firstname }}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                           <div class="form-group">
                                                                <label for="simpleFormEmail">Last Name</label>
                                                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter user last name" value="{{ $userdetails[0]->lastname }}">
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Investor Type</label>
                                                                <select class="form-control select2-hidden-accessible" name="investortype" id="investortype" tabindex="-1" aria-hidden="true">
                                                                    <option value="">Investor Type</option>
                                                                    <option value="Individual Investor" {{ $userdetails[0]->investortype != null && $userdetails[0]->investortype == 'Individual Investor' ? 'selected="selected"' : '' }} >Individual Investor</option>
                                                                    <option value="Business Investor" {{ $userdetails[0]->investortype != null && $userdetails[0]->investortype == 'Business Investor' ? 'selected="selected"' : '' }}>Business Investor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Interest IN</label>
                                                                <select multiple class="form-control select2-hidden-accessible" name="interestin[]" id="interestin" tabindex="-1" aria-hidden="true">
                                                                    @php
                                                                        $tempInterest=explode(",",$userdetails[0]->interestin);
                                                                    @endphp
                                                                    <option value="Startup" {{ in_array('Startup',$tempInterest) ? 'selected="selected"' : '' }}>Startup</option>
                                                                    <option value="Early Stage" {{ in_array('Early Stage',$tempInterest) ? 'selected="selected"' : '' }}>Early Stage</option>
                                                                    <option value="Expansion" {{ in_array('Expansion',$tempInterest) ? 'selected="selected"' : '' }}>Expansion</option>
                                                                </select>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="mnumber">Mobile Number</label>
                                                                <input type="text" class="form-control" name="mnumber" id="mnumber" minlength="8" maxlength="12" placeholder="Enter user mobile number" value="{{ $userdetails[0]->number != null ? $userdetails[0]->number : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                           <div class="form-group">
                                                                <label for="altnumber">Alternative phone number</label>
                                                                <input type="text" class="form-control" name="altnumber" id="altnumber" maxlength="15"  minlength="8" placeholder="Enter user alertnative number" value="{{ $userdetails[0]->phone_number != null ? $userdetails[0]->phone_number : '' }}">
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="country">Country</label>
                                                                <select class="form-control select2-hidden-accessible" name="country" id="country" tabindex="-1" aria-hidden="true">
                                                                    @foreach($countryname as $key => $value)
                                                                        <option value="{{ $value['id'] }}" {{ $userdetails[0]->country != null && $userdetails[0]->country == $value['id'] ? 'selected="selected"' : '' }}>{{ $value['name'] }}</option>
                                                                    @endforeach  
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="state">State</label>
                                                                <select class="form-control select2-hidden-accessible state" name="state" id="state" tabindex="-1" aria-hidden="true">
                                                                    @foreach($statelist as $key => $value)
                                                                        <option value="{{ $value['id'] }}" {{ $userdetails[0]->state != null && $userdetails[0]->state == $value['id'] ? 'selected="selected"' : '' }}>{{ $value['name'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="city">City</label>
                                                                <select class="form-control select2-hidden-accessible city" name="city" id="city" tabindex="-1" aria-hidden="true">
                                                                    @foreach($citylist as $key => $value)
                                                                        <option value="{{ $value['id'] }}" {{ $userdetails[0]->city != null && $userdetails[0]->city == $value['id'] ? 'selected="selected"' : '' }}>{{ $value['name'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="pincode">Pincode</label>
                                                                <input type="text" class="form-control" maxlength="12" name="pincode" id="pincode" placeholder="Pincode" value="{{ $userdetails[0]->pincode != null ? $userdetails[0]->pincode : '' }}">
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="row"> 
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="address">Address</label>
                                                                <textarea class="form-control" name="address" maxlength="100" id="address" rows="3" placeholder="Address...">{{ $userdetails[0]->address != null ? $userdetails[0]->address : '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                           <div class="form-group">
                                                                <label for="website">Website</label>
                                                                <input type="text" class="form-control" name="website" id="website" placeholder="Website" value="{{ $userdetails[0]->website != null ? $userdetails[0]->website : '' }}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                           <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $userdetails[0]->email != null ? $userdetails[0]->email : '' }}">
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                           <div class="form-group">
                                                                <label for="companyname">Company Name</label>
                                                                <input type="text" class="form-control" name="companyname" id="companyname" placeholder="Company Name" value="{{ $userdetails[0]->companyname != null ? $userdetails[0]->companyname : '' }}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                           <div class="form-group">
                                                                <label for="designation">Designation</label>
                                                                <select class="form-control select2-hidden-accessible" name="designation" id="designation" tabindex="-1" aria-hidden="true">
                                                                    <option value="">Designation *</option>
                                                                    @foreach($designationlist as $key => $value)
                                                                        <option value="{{ $value->de_id}}" {{ $userdetails[0]->designation != null && $userdetails[0]->designation == $value->de_id ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="industry">Industry</label>
                                                                <select class="form-control select2-hidden-accessible" name="industry[]" id="industry" tabindex="-1" aria-hidden="true" placeholder="Industry" multiple>
                                                                    <option value="">Industry *</option>
                                                                    @php 
                                                                        $temIndArr=explode(",",$userdetails[0]->industry);
                                                                    @endphp
                                                                    @foreach($industrylist as $key => $value)
                                                                        <option value="{{ $value['id'] }}" {{ !empty($temIndArr) && in_array($value['id'],$temIndArr) ? 'selected' : '' }}>{{ $value['industry'] }}</option>
                                                                    @endforeach  
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                           <div class="form-group">
                                                                <label for="gst">Intrested Country</label>
                                                                <select class="form-control select2-hidden-accessible" name="interestedcountry[]" id="interestedcountry" tabindex="-1" aria-hidden="true" placeholder="Select Interested Country" multiple>
                                                                    @php
                                                                        $tempIntCountry =explode(",",$userdetails[0]->interested_country);
                                                                    @endphp
                                                                    @foreach($countryname as $key => $value)
                                                                        <option value="{{ $value['name'] }}" {{ in_array($value['name'],$tempIntCountry) ? 'selected="selected"' : '' }}>{{ $value['name'] }}</option>
                                                                    @endforeach  
                                                                </select>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="gst">GST Number</label>
                                                                <input type="text" class="form-control" name="gst" id="gst" placeholder="GST" value="{{ $userdetails[0]->gst != null ? $userdetails[0]->gst : '' }}">
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="row"> 
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="introduction">Introduction</label>
                                                                <textarea class="form-control" name="introduction" id="introduction" rows="3" placeholder="Introduction...">{{ $userdetails[0]->intro != null ? $userdetails[0]->intro : '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row"> 
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="companyintro">Company Introduction</label>
                                                                <textarea class="form-control" name="companyintro" id="companyintro" rows="3" placeholder="Brief introduction about your company...">{{ $userdetails[0]->company_intro != null ? $userdetails[0]->company_intro : '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                           <div class="form-group">
                                                                <label for="min_investment">Min Investment</label>
                                                                <input type="text"      class="form-control inrformat"  name="min_investment_dis" id="min_investment_dis" onkeypress="return isNumber(event);" minlength="5" maxlength="15" placeholder="Min Investment Offered" value="{{ $userdetails[0]->min_investment != null ? $userdetails[0]->min_investment : '' }}"/>
                                                                <input type="hidden"  class="nomoneyformat" name="min_investment" id="min_investment" onkeypress="return isNumber(event);" minlength="5" maxlength="11" placeholder="Min Investment Offered " value="{{ $userdetails[0]->min_investment != null ? $userdetails[0]->min_investment : '' }}"/>
                                                                
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                           <div class="form-group">
                                                                <label for="max_investment">Max Investment</label>
                                                                <input type="text"      class="form-control inrformat"  name="max_investment_dis" id="max_investment_dis" onkeypress="return isNumber(event);" minlength="5" maxlength="15" placeholder="Max Investment Offered" value="{{ $userdetails[0]->max_investment != null ? $userdetails[0]->max_investment : '' }}"/>
                                                                <input type="hidden"  class="nomoneyformat" name="max_investment" id="max_investment" onkeypress="return isNumber(event);" minlength="5" maxlength="11" placeholder="Max Investment Offered " value="{{ $userdetails[0]->max_investment != null ? $userdetails[0]->max_investment : '' }}"/>
                                                               
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    
                                                        
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                               
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
    <!-- end page content -->
   

   
@endsection