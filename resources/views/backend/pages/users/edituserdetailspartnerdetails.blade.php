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
                    <div class="page-title">Partner Edit Details</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="{{ route("all-users") }}">All Users</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Partner Edit Details</li>
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
                                        <a class="nav-link active show" href="#tab1" data-toggle="tab">Partner Details</a>
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
                                                 <form method="post" action="{{ route('edit-partner-detail',$user_id)}}" enctype="multipart/form-data" id="editpartnerdetails-form">{{ csrf_field() }}
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
                                                                <label for="simpleFormEmail">Designation</label>
                                                                <select class="form-control select2-hidden-accessible" name="designation" id="designation" tabindex="-1" aria-hidden="true">
                                                                    @foreach($designationlist as $key => $value)
                                                                    <option value="{{ $value->de_id}}" {{ $userdetails[0]->designation != null && $userdetails[0]->designation == $value->de_id ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Email</label>
                                                                <input type="email" class="form-control" name="email" id="simpleFormEmail" placeholder="Enter user email" value="{{$userdetails[0]->email}}">
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Company Name</label>
                                                                <input type="text" class="form-control" maxlength="40" name="company" id="companyname" placeholder="Enter user company name" value="{{ $userdetails[0]->companyname != null ? $userdetails[0]->companyname : '' }}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Company Site</label>
                                                                <input type="text" class="form-control" name="website" id="companysite" placeholder="Enter user company site" value="{{ $userdetails[0]->website != null ? $userdetails[0]->website : '' }}">
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row">

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="simpleFormEmail">Mobile Number</label>
                                                                        <input type="text" class="form-control" minlength="8" maxlength="12" name="mnumber" id="mobilenumber" placeholder="Enter user mobile number" value="{{ $userdetails[0]->number != null ? $userdetails[0]->number : '' }}">
                                                                    </div> 
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Alternative phone number</label>
                                                                <input type="text" class="form-control" maxlength="15"  minlength="8" name="altnumber" id="alt_number" placeholder="Enter user alertnative number" value="{{ $userdetails[0]->phone_number != null ? $userdetails[0]->phone_number : '' }}">
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Address</label>
                                                                <textarea class="form-control" maxlength="250" name="address" >{{ $userdetails[0]->address != null ? $userdetails[0]->address : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Country</label>
                                                                <select class="form-control select2-hidden-accessible" name="country" id="country" tabindex="-1" aria-hidden="true">
                                                                    <option value="" >Select Country</option>
                                                                    @foreach($countryname as $key => $value)
                                                                        <option value="{{ $value->id }}" {{ $value->id == $userdetails[0]->country ? 'selected' : ''}}>{{ $value->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">State</label>
                                                                <select class="form-control select2-hidden-accessible" name="state" id="state" tabindex="-1" aria-hidden="true">
                                                                    @foreach($statelist as $key => $value)
                                                                        <option value="{{ $value->id }}" {{ $userdetails[0]->state != null && $userdetails[0]->state == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
                                                                    @endforeach  
                                                                </select>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group city">
                                                                <label for="simpleFormEmail">City</label>
                                                                <select class="form-control select2-hidden-accessible" name="city" id="city" tabindex="-1" aria-hidden="true">
                                                                    @foreach($citylist as $key => $value)
                                                                        <option value="{{ $value->id }}" {{ $userdetails[0]->city != null && $userdetails[0]->city == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
                                                                    @endforeach  
                                                                </select>
                                                            </div> 
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Pin code</label>
                                                                <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Enter user pincode" value="{{ $userdetails[0]->pincode != null ? $userdetails[0]->pincode : '' }}" maxlength="12">
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">GST Number</label>
                                                                <input type="text" class="form-control" name="gst" id="gst" placeholder="Enter GST Number" value="{{ $userdetails[0]->gst != null ? $userdetails[0]->gst : '' }}">
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