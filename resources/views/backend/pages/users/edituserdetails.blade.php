@extends('backend.layout.layout')
@section('content')
@php
$imagearry = explode("," , $userdetails[0]->images_array);
$imagearry_id = explode("," , $userdetails[0]->images_array_id);

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
                    <div class="page-title">Edit User Details</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="{{ route("all-users") }}">All Users</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Edit User Details</li>
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
                                    <li class="nav-item tab-all"><a
                                            class="nav-link active show" href="#tab1" data-toggle="tab">About Users</a></li>
                                    <li class="nav-item tab-all p-l-20"><a class="nav-link"
                                                                           href="#tab2" data-toggle="tab">Company Details</a></li>
                                    <li class="nav-item tab-all p-l-20"><a class="nav-link"
                                                                           href="#tab3" data-toggle="tab">Payment Details</a></li>
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
                                                <form method="post" action="" enctype="multipart/form-data" id="editfundriserdetail-form">{{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">First Name</label>
                                                                <input type="text" class="form-control"  name="firstname" id="firstname" placeholder="Enter user first name" value="{{$userdetails[0]->firstname}}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Last Name</label>
                                                                <input type="text" class="form-control" value="{{$userdetails[0]->lastname}}" name="lastname" id="lastname" placeholder="Enter user last name">
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
                                                                    @foreach($countrylist as $key => $value)
                                                                        <option value="{{ $value->id }}" {{ $value->id == $fundriserdetais[0]->country ? 'selected' : ''}}>{{ $value->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">State</label>
                                                                <select class="form-control select2-hidden-accessible" name="state" id="state" tabindex="-1" aria-hidden="true">
                                                                    @foreach($statelist as $key => $value)
                                                                        <option value="{{ $value->id }}" {{ $fundriserdetais[0]->state != null && $fundriserdetais[0]->state == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
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
                                                                        <option value="{{ $value->id }}" {{ $fundriserdetais[0]->city != null && $fundriserdetais[0]->city == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
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

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Industry</label>
                                                                <select class="form-control select2-hidden-accessible" name="industry" id="industry" tabindex="-1" aria-hidden="true">
                                                                    <option value="" >Industry *</option>
                                                                    @foreach($industrylist as $key => $value)
                                                                    <option value="{{ $value->id }}" {{ $userdetails[0]->industry != null && $userdetails[0]->industry == $value->id ? 'selected="selected"' : '' }}>{{ $value->industry  }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">GST Number</label>
                                                                <input type="text" class="form-control" name="gst" id="gst" placeholder="Enter GST Number" value="{{ $userdetails[0]->gst != null ? $userdetails[0]->gst : '' }}">
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="simpleFormEmail">Partner Code</label>
                                                        <input type="text" class="form-control" name="partnercode" id="partnercode" placeholder="Enter Partner Code" value="{{ $userdetails[0]->partnercode != null ? $userdetails[0]->partnercode : '' }}" {{ $userdetails[0]->partnercode != null ? 'disabled="disabled"' : '' }}>
                                                    </div>
                                                    
                                                    <div class="row">                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Note</label>
                                                                <textarea class="form-control" name="note" id="note">{{ $userdetails[0]->user_note != null ? $userdetails[0]->user_note : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Exclusive introductions of your profile to investors (Via Email)</label>
                                                                <input type="text" class="form-control" name="count" id="count" placeholder="Enter number of exclusive introductions of your profile to investors (Via Email)" value="{{ $userdetails[0]->count }}" >
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="tab-pane" id="tab2">
                                    <div id="biography" >

                                        <div class="row profilecoderow">
                                            <div class="col-md-6 col-6 b-r"> <strong>User Profile Code</strong>
                                                <br>
                                                <span class="label label-lg label-success lblprofilecode ">{{ $userdetails[0]->profile_code }}</span>
                                            </div>
                                            <div class="col-md-6 col-6 b-r "> <strong>User Type</strong>
                                                <br>
                                                <span class="label label-lg label-danger">{{ $usertype }}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="card-body " id="bar-parent1">
                                                <form method="post" action="{{ route('edit-fund-detail',$user_id)}}" enctype="multipart/form-data" id="editFRcompanydetails-form">{{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Min Investment Amount</label>
                                                                <input type="text"      class="form-control inrformat"  name="min_investment_dis" id="min_investment_dis" onkeypress="return isNumber(event);" minlength="6" maxlength="15" placeholder="Min Investment Required *" value="{{ $userdetails[0]->min_investment != null ? $userdetails[0]->min_investment : '' }}"/>
                                                                <input type="hidden"  class="nomoneyformat" name="min_investment" id="min_investment" onkeypress="return isNumber(event);" minlength="6" maxlength="11" placeholder="Min Investment Required *" value="{{ $userdetails[0]->min_investment != null ? $userdetails[0]->min_investment : '' }}"/>
                                                                
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Max Investment Amount</label>
                                                                <input type="text"      class="form-control inrformat"  name="max_investment_dis" id="max_investment_dis" onkeypress="return isNumber(event);" minlength="6" maxlength="15" placeholder="Max Investment Required *" value="{{ $userdetails[0]->max_investment != null ? $userdetails[0]->max_investment : '' }}"/>
                                                                <input type="hidden"  class="nomoneyformat" name="max_investment" id="max_investment" onkeypress="return isNumber(event);" minlength="6" maxlength="11" placeholder="Max Investment Required *" value="{{ $userdetails[0]->max_investment != null ? $userdetails[0]->max_investment : '' }}"/>
                                                               
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Min Investment Accepated</label>
                                                                <input type="text"      class="form-control inrformat"  name="min_accepted_dis" id="min_accepted_dis" onkeypress="return isNumber(event);" minlength="5" maxlength="15" placeholder="Min Investment Accepted *" value="{{ $userdetails[0]->min_investment_accepated != null ? $userdetails[0]->min_investment_accepated : '' }}"/>
                                                                <input type="hidden"  class="nomoneyformat" name="min_accepted" id="min_accepted" onkeypress="return isNumber(event);" minlength="5" maxlength="11" placeholder="Min Investment Accepted *" value="{{ $userdetails[0]->min_investment_accepated != null ? $userdetails[0]->min_investment_accepated : '' }}"/>
                                                               
                                                                
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">USP 1</label>
                                                                <textarea class="form-control" name="usp1" id="usp1" placeholder="In 150 Words *" maxlength="150">{{ $userdetails[0]->usp1 != null ? $userdetails[0]->usp1 : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">USP 2</label>
                                                                <textarea class="form-control" name="usp2" id="usp2" placeholder="In 150 Words *" maxlength="150">{{ $userdetails[0]->usp2 != null ? $userdetails[0]->usp2 : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">USP 3</label>
                                                                <textarea class="form-control" name="usp3" id="usp3" placeholder="In 150 Words" maxlength="150">{{ $userdetails[0]->usp3 != null ? $userdetails[0]->usp3 : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">USP 4</label>
                                                                <textarea class="form-control" name="usp4" id="usp4" placeholder="In 150 Words" maxlength="150">{{ $userdetails[0]->usp4 != null ? $userdetails[0]->usp4 : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Introduction</label>
                                                                <textarea class="form-control" name="introduction" id="introduction" placeholder="Introduce Your Self / Company / Product (In 40 Words Only) *" maxlength="300">{{ $userdetails[0]->intro != null ? $userdetails[0]->intro : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Idea</label>
                                                                <textarea class="form-control" name="idea" id="idea" placeholder="Describe your business (In 2200 Words Only) *" maxlength="2200">{{ $userdetails[0]->idea != null ? $userdetails[0]->idea : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Team Overview</label>
                                                                <textarea class="form-control" name="team_overview" id="team_overview" placeholder="About your team members (In 700 Words Only) *"  maxlength="700">{{ $userdetails[0]->team != null ? $userdetails[0]->team : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Team Member 1</label>
                                                                <input type="text" class="form-control"  name="member1" id="member1" placeholder="Team Member 1 *" maxlength="30" value="{{$userdetails[0]->team_mem1}}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Member 1 Designation</label>
                                                                <select class="form-control select2-hidden-accessible" name="position1" id="position1" tabindex="-1" aria-hidden="true">
                                                                    <option value="">Designation *</option>
                                                                    @foreach($designationlist as $key => $value)
                                                                    <option value="{{ $value->short}}" {{ $userdetails[0]->team_mem_deg1 != null && $userdetails[0]->team_mem_deg1 == $value->short ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Team Member 2</label>
                                                                <input type="text" class="form-control"  name="member2" id="member2" maxlength="30" placeholder="Team Member 2" value="{{$userdetails[0]->team_mem2}}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Member 2 Designation</label>
                                                                <select class="form-control select2-hidden-accessible" name="position2" id="position2" tabindex="-1" aria-hidden="true">
                                                                    <option value="">Designation *</option>
                                                                    @foreach($designationlist as $key => $value)
                                                                    <option value="{{ $value->short}}" {{ $userdetails[0]->team_mem_deg2 != null && $userdetails[0]->team_mem_deg2 == $value->short ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Team Member 3</label>
                                                                <input type="text" class="form-control"  name="member3" id="member3" placeholder="Team Member 3" maxlength="30" value="{{$userdetails[0]->team_mem3}}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Member 3 Designation</label>
                                                                <select class="form-control select2-hidden-accessible" name="position3" id="position3" tabindex="-1" aria-hidden="true">
                                                                    <option value="">Designation *</option>
                                                                    @foreach($designationlist as $key => $value)
                                                                    <option value="{{ $value->short}}" {{ $userdetails[0]->team_mem_deg3 != null && $userdetails[0]->team_mem_deg3 == $value->short ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Team Member 4</label>
                                                                <input type="text" class="form-control"  name="member4" id="member4" maxlength="30"  placeholder="Team Member 4" value="{{$userdetails[0]->team_mem4}}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Member 4 Designation</label>
                                                                <select class="form-control select2-hidden-accessible" name="position4" id="position4" tabindex="-1" aria-hidden="true">
                                                                    <option value="">Designation *</option>
                                                                    @foreach($designationlist as $key => $value)
                                                                    <option value="{{ $value->short}}" {{ $userdetails[0]->team_mem_deg4 != null && $userdetails[0]->team_mem_deg4 == $value->short ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                    <div class="col-md-12 col-12 b-r"> <strong>Team Member Images</strong>
                                                        <br>
                                                        @if( $userdetails[0]->member_image == null || $userdetails[0]->member_image == "")
                                                            <img class="img-responsive" style="width:350px; height:200px "src="{{ asset('public/frontend/image/no-image.png') }}" >
                                                            <!--<p class="m-t-30"> Not available </p>-->
                                                        @else
                                                            <img class="img-responsive" style="width:350px; height:200px "src="{{ asset('public/upload/team_member/'. $userdetails[0]->member_image) }}" >
                                                        @endif
                                                    </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Picture Of Team Member</label>
                                                                <input type="file" class="form-control" name="member_picture" id="member_picture" value="" >
                                                            </div> 
                                                        </div>

                                                        <div class="row">
                                                            @if( count($imagearry) == 0)
                                                                <div class="col-md-3 col-3 b-r"> 
                                                                        <img class="img-responsive" style="width:350px; height:200px "src="{{ asset('public/frontend/image/no-image.png') }}" >
                                                                </div>
                                                                
                                                            @else
                                                                @for($i = 0; $i < count($imagearry) ; $i++)
                                                                    <div class="col-md-3 col-3 b-r" id="img_id{{ $imagearry_id[$i] }}"> 
                                                                        <img class="img-responsive" style=" width:350px; height:200px; margin:10px" src="{{ asset('public/upload/company_details/'.$imagearry[$i]) }}" >
                                                                        <div class="overlay text text-center">
                                                                            <button data-toggle="modal" data-target="#deleteModel" type="button" class="delete_img btn " data-product_image="{{  $imagearry[$i] }}" image-id="{{  $imagearry_id[$i]  }}">
                                                                                Delete Image
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                @endfor
                                                            @endif
                                                            
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Images Of Product/Company/Project (Max 10 Files)</label>
                                                                <input type="file" class="form-control" name="mul_imgs[]" multiple="multiple"  id="mul_imgs" value="">
                                                            </div> 
                                                        </div>


                                                        <div class="col-md-6 col-6 b-r" id="videodiv"> <strong>Video</strong>
                                                            <br>
                                                            @if( $userdetails[0]->video == null || $userdetails[0]->video == "")
                                                                <img class="img-responsive" style="width:350px; height:200px "src="{{ asset('public/frontend/image/no-video.jpg') }}" >
                                                            @else
                                                            <video   controls>
                                                                <source src="{{ asset('public/upload/video/'.$userdetails[0]->video) }}" type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video><br><br>
                                                            <div class="overlay ">
                                                                <button data-toggle="modal" data-target="#deleteVideoModel" type="button" class="delete_video btn " data-video="{{  $userdetails[0]->video }}" data-id="{{  $userdetails[0]->videoId }}">
                                                                    Delete Video
                                                                </button>
                                                            </div>
                                                            <br><br>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Video</label>
                                                                <input type="file" class="form-control" name="up_video" id="up_video"  value="">
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Return of Investment</label>
                                                                <input type="text" class="form-control"  name="roi" id="roi" maxlength="3" placeholder="%" value="{{$userdetails[0]->roi}}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Cost of Capital</label>
                                                                <input type="text" class="form-control" value="{{$userdetails[0]->cop}}" id="coc" name="coc" maxlength="3" placeholder="%">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Promotions Investment</label>
                                                                <input type="text" class="form-control" value="{{$userdetails[0]->pi}}" id="pi" name="pi" maxlength="11" placeholder="INR">
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Assured Minimum Dividend</label>
                                                                <input type="text" class="form-control"  id="amd" name="amd" maxlength="3" placeholder="%" value="{{$userdetails[0]->dividend}}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Fixed Assests</label>
                                                                <input type="text" class="form-control" value="{{$userdetails[0]->fa}}" id="fa" name="fa" maxlength="11" placeholder="INR">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Ebitda</label>
                                                                <input type="text" class="form-control" value="{{$userdetails[0]->ebitda}}" id="ebitda" name="ebitda" maxlength="3" placeholder="%">
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab3">
                                    <div id="biography" >

                                        <div class="row profilecoderow">
                                            <div class="col-md-6 col-6 b-r"> <strong>User Profile Code</strong>
                                                <br>
                                                <span class="label label-lg label-success lblprofilecode ">{{ $userdetails[0]->profile_code }}</span>
                                            </div>


                                            <div class="col-md-6 col-6 b-r "> <strong>User Type</strong>
                                                <br>
                                                <span class="label label-lg label-danger">{{ $usertype }}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 col-6 b-r"> <strong>Payment No</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->payment_no }}</p>
                                            </div>
                                            
                                            <div class="col-md-6 col-6"> <strong>Plan Status</strong>
                                                <br>
                                                @if($userdetails[0]->paymnet_status == "S")
                                                <span class="label label-lg label-success">Success</span>

                                                @else
                                                @if($userdetails[0]->paymnet_status == "P")
                                                <span class="label label-lg label-info">Verified</span>                                                
                                                @else
                                                <span class="label label-lg label-danger">Pending</span>
                                                @endif
                                                @endif

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="card-body " id="bar-parent1">
                                                <form method="post" action="{{ route('edit-fund-payment',$user_id)}}" enctype="multipart/form-data" id="editFRpayment-form">{{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Payment Amount</label>
                                                                <select class="form-control select2-hidden-accessible" disabled name="amount_dup" id="amount_dup" tabindex="-1" aria-hidden="true">
                                                                    <option value="" >Payment Amount*</option>
                                                                   
                                                                    <option value="0" {{ $userdetails[0]->amount != null && $userdetails[0]->amount == '0' ? 'selected="selected"' : '' }}>0</option>
                                                                    <option value="5000" {{ $userdetails[0]->amount != null && $userdetails[0]->amount == '5000' ? 'selected="selected"' : '' }}>5000</option>
                                                                    <option value="10000" {{ $userdetails[0]->amount != null && $userdetails[0]->amount == '10000' ? 'selected="selected"' : '' }}>10000</option>
                                                                    <option value="15000" {{ $userdetails[0]->amount != null && $userdetails[0]->amount == '15000' ? 'selected="selected"' : '' }}>15000</option>
                                                                    <option value="20000" {{ $userdetails[0]->amount != null && $userdetails[0]->amount == '20000' ? 'selected="selected"' : '' }}>20000</option>
                                                                    <option value="50000" {{ $userdetails[0]->amount != null && $userdetails[0]->amount == '50000' ? 'selected="selected"' : '' }}>50000</option>
                                                                </select>
                                                                <input type="hidden" name="amount" id="amount" value="{{$userdetails[0]->amount == null ?0:$userdetails[0]->amount}} " />
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Plan Name</label>
                                                                <select class="form-control select2-hidden-accessible" name="planname" id="planname" tabindex="-1" aria-hidden="true">
                                                                    <option value="" >Plan Name*</option>
                                                                   
                                                                    <option value="Free" {{ $userdetails[0]->planname != null && $userdetails[0]->planname == 'Free' ? 'selected="selected"' : '' }}>Free</option>
                                                                    <option value="Treasure" {{ $userdetails[0]->planname != null && $userdetails[0]->planname == 'Treasure' ? 'selected="selected"' : '' }}>Treasure</option>
                                                                    <option value="Gilded" {{ $userdetails[0]->planname != null && $userdetails[0]->planname == 'Gilded' ? 'selected="selected"' : '' }}>Gilded</option>
                                                                    <option value="Platinum" {{ $userdetails[0]->planname != null && $userdetails[0]->planname == 'Platinum' ? 'selected="selected"' : '' }}>Platinum</option>
                                                                    <option value="Preferred" {{ $userdetails[0]->planname != null && $userdetails[0]->planname == 'Preferred' ? 'selected="selected"' : '' }}>Preferred</option>
                                                                    <option value="Royal" {{ $userdetails[0]->planname != null && $userdetails[0]->planname == 'Royal' ? 'selected="selected"' : '' }}>Royal</option>
                                                                </select>
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
    <!-- start chat sidebar -->
    <div class="chat-sidebar-container" data-close-on-body-click="false">
        <div class="chat-sidebar">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#quick_sidebar_tab_1" class="nav-link active tab-icon"  data-toggle="tab">Theme
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#quick_sidebar_tab_2" class="nav-link tab-icon"  data-toggle="tab"> Chat
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#quick_sidebar_tab_3" class="nav-link tab-icon"  data-toggle="tab">  Settings
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane chat-sidebar-settings in show active animated shake" role="tabpanel" id="quick_sidebar_tab_1">
                    <div class="slimscroll-style">
                        <div class="theme-light-dark">
                            <h6>Sidebar Theme</h6>
                            <button type="button" data-theme="white" class="btn lightColor btn-outline btn-circle m-b-10 theme-button">Light Sidebar</button>
                            <button type="button" data-theme="dark" class="btn dark btn-outline btn-circle m-b-10 theme-button">Dark Sidebar</button>
                        </div>
                        <div class="theme-light-dark">
                            <h6>Sidebar Color</h6>
                            <ul class="list-unstyled">
                                <li class="complete">
                                    <div class="theme-color sidebar-theme">
                                        <a href="#" data-theme="white"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="dark"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="blue"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="indigo"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="cyan"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="green"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="red"><span class="head"></span><span class="cont"></span></a>
                                    </div>
                                </li>
                            </ul>
                            <h6>Header Brand color</h6>
                            <ul class="list-unstyled">
                                <li class="theme-option">
                                    <div class="theme-color logo-theme">
                                        <a href="#" data-theme="logo-white"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="logo-dark"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="logo-blue"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="logo-indigo"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="logo-cyan"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="logo-green"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="logo-red"><span class="head"></span><span class="cont"></span></a>
                                    </div>
                                </li>
                            </ul>
                            <h6>Header color</h6>
                            <ul class="list-unstyled">
                                <li class="theme-option">
                                    <div class="theme-color header-theme">
                                        <a href="#" data-theme="header-white"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="header-dark"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="header-blue"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="header-indigo"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="header-cyan"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="header-green"><span class="head"></span><span class="cont"></span></a>
                                        <a href="#" data-theme="header-red"><span class="head"></span><span class="cont"></span></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Start Doctor Chat --> 
                <div class="tab-pane chat-sidebar-chat animated slideInRight" id="quick_sidebar_tab_2">
                    <div class="chat-sidebar-list">
                        <div class="chat-sidebar-chat-users slimscroll-style" data-rail-color="#ddd" data-wrapper-class="chat-sidebar-list">
                            <div class="chat-header"><h5 class="list-heading">Online</h5></div>
                            <ul class="media-list list-items">
                                <li class="media"><img class="media-object" src="assets/img/user/user3.jpg" width="35" height="35" alt="...">
                                    <i class="online dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">John Deo</h5>
                                        <div class="media-heading-sub">Spine Surgeon</div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-success">5</span>
                                    </div> <img class="media-object" src="assets/img/user/user1.jpg" width="35" height="35" alt="...">
                                    <i class="busy dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Rajesh</h5>
                                        <div class="media-heading-sub">Director</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="assets/img/user/user5.jpg" width="35" height="35" alt="...">
                                    <i class="away dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Jacob Ryan</h5>
                                        <div class="media-heading-sub">Ortho Surgeon</div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-danger">8</span>
                                    </div> <img class="media-object" src="assets/img/user/user4.jpg" width="35" height="35" alt="...">
                                    <i class="online dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Kehn Anderson</h5>
                                        <div class="media-heading-sub">CEO</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="assets/img/user/user2.jpg" width="35" height="35" alt="...">
                                    <i class="busy dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Sarah Smith</h5>
                                        <div class="media-heading-sub">Anaesthetics</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="assets/img/user/user7.jpg" width="35" height="35" alt="...">
                                    <i class="online dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Vlad Cardella</h5>
                                        <div class="media-heading-sub">Cardiologist</div>
                                    </div>
                                </li>
                            </ul>
                            <div class="chat-header"><h5 class="list-heading">Offline</h5></div>
                            <ul class="media-list list-items">
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-warning">4</span>
                                    </div> <img class="media-object" src="assets/img/user/user6.jpg" width="35" height="35" alt="...">
                                    <i class="offline dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Jennifer Maklen</h5>
                                        <div class="media-heading-sub">Nurse</div>
                                        <div class="media-heading-small">Last seen 01:20 AM</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="assets/img/user/user8.jpg" width="35" height="35" alt="...">
                                    <i class="offline dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Lina Smith</h5>
                                        <div class="media-heading-sub">Ortho Surgeon</div>
                                        <div class="media-heading-small">Last seen 11:14 PM</div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-success">9</span>
                                    </div> <img class="media-object" src="assets/img/user/user9.jpg" width="35" height="35" alt="...">
                                    <i class="offline dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Jeff Adam</h5>
                                        <div class="media-heading-sub">Compounder</div>
                                        <div class="media-heading-small">Last seen 3:31 PM</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="assets/img/user/user10.jpg" width="35" height="35" alt="...">
                                    <i class="offline dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Anjelina Cardella</h5>
                                        <div class="media-heading-sub">Physiotherapist</div>
                                        <div class="media-heading-small">Last seen 7:45 PM</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <!-- End Doctor Chat --> 
                <!-- Start Setting Panel --> 
                <div class="tab-pane chat-sidebar-settings animated slideInUp" id="quick_sidebar_tab_3">
                    <div class="chat-sidebar-settings-list slimscroll-style">
                        <div class="chat-header"><h5 class="list-heading">Layout Settings</h5></div>
                        <div class="chatpane inner-content ">
                            <div class="settings-list">
                                <div class="setting-item">
                                    <div class="setting-text">Sidebar Position</div>
                                    <div class="setting-set">
                                        <select class="sidebar-pos-option form-control input-inline input-sm input-small ">
                                            <option value="left" selected="selected">Left</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">Header</div>
                                    <div class="setting-set">
                                        <select class="page-header-option form-control input-inline input-sm input-small ">
                                            <option value="fixed" selected="selected">Fixed</option>
                                            <option value="default">Default</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">Sidebar Menu </div>
                                    <div class="setting-set">
                                        <select class="sidebar-menu-option form-control input-inline input-sm input-small ">
                                            <option value="accordion" selected="selected">Accordion</option>
                                            <option value="hover">Hover</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">Footer</div>
                                    <div class="setting-set">
                                        <select class="page-footer-option form-control input-inline input-sm input-small ">
                                            <option value="fixed">Fixed</option>
                                            <option value="default" selected="selected">Default</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-header"><h5 class="list-heading">Account Settings</h5></div>
                            <div class="settings-list">
                                <div class="setting-item">
                                    <div class="setting-text">Notifications</div>
                                    <div class="setting-set">
                                        <div class="switch">
                                            <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
                                                   for = "switch-1">
                                                <input type = "checkbox" id = "switch-1" 
                                                       class = "mdl-switch__input" checked>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">Show Online</div>
                                    <div class="setting-set">
                                        <div class="switch">
                                            <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
                                                   for = "switch-7">
                                                <input type = "checkbox" id = "switch-7" 
                                                       class = "mdl-switch__input" checked>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">Status</div>
                                    <div class="setting-set">
                                        <div class="switch">
                                            <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
                                                   for = "switch-2">
                                                <input type = "checkbox" id = "switch-2" 
                                                       class = "mdl-switch__input" checked>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">2 Steps Verification</div>
                                    <div class="setting-set">
                                        <div class="switch">
                                            <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
                                                   for = "switch-3">
                                                <input type = "checkbox" id = "switch-3" 
                                                       class = "mdl-switch__input" checked>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-header"><h5 class="list-heading">General Settings</h5></div>
                            <div class="settings-list">
                                <div class="setting-item">
                                    <div class="setting-text">Location</div>
                                    <div class="setting-set">
                                        <div class="switch">
                                            <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
                                                   for = "switch-4">
                                                <input type = "checkbox" id = "switch-4" 
                                                       class = "mdl-switch__input" checked>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">Save Histry</div>
                                    <div class="setting-set">
                                        <div class="switch">
                                            <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
                                                   for = "switch-5">
                                                <input type = "checkbox" id = "switch-5" 
                                                       class = "mdl-switch__input" checked>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">Auto Updates</div>
                                    <div class="setting-set">
                                        <div class="switch">
                                            <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
                                                   for = "switch-6">
                                                <input type = "checkbox" id = "switch-6" 
                                                       class = "mdl-switch__input" checked>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="deleteVideoModel" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Delete Record</h3>
                            Are You sure want to delete video ?<br/>
                            <input type="hidden" value="0" id="hidmodalDeleteId" />
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-l" style="margin: 10px;"data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-sm btn-danger pull-right yes-sure-deleteVideoModel m-l " style="margin: 10px;"  type="button" ><strong><i class="fa fa-trash"></i> Delete </strong></button>
                                </div>
    
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->


    @endsection