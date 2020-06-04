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
                    <div class="page-title">User Details</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="{{ route("all-users") }}">All Users</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">User Details</li>
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
                                        <a class="nav-link active show" href="#tab1" data-toggle="tab">About Investor</a>
                                    </li>  
                                    <li class="nav-item tab-all p-l-20">
                                        <a class="nav-link" href="#tab2" data-toggle="tab">Investor Details</a>
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
                                            <div class="col-md-6 col-6 b-r"> <strong>Full Name</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->firstname }} {{ $userdetails[0]->lastname }}</p>
                                            </div>
                                            <div class="col-md-6 col-6 b-r"> <strong>Mobile</strong>
                                                <br>
                                                <p class="text-muted"> {{ $userdetails[0]->number }}</p>
                                            </div>
                                            <div class="col-md-6 col-6 b-r"> <strong>Email</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->email }}</p>
                                            </div>
                                            <div class="col-md-6 col-6"> <strong>Location</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->cityname }},{{ $userdetails[0]->statename }},{{ $userdetails[0]->countryname }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-3 col-6 b-r"> <strong>Ip Address </strong>
                                                <br>
                                                <span class="label label-lg ">{{ $userdetails[0]->ip }}</span>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> 
                                                <strong>Email Verify status</strong>
                                                <br>
                                                @if($userdetails[0]->verify_status == "1")
                                                    <span class="label label-lg label-success">Verified</span>
                                                @else
                                                    <span class="label label-lg label-danger">Not verified</span>
                                                @endif
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> 
                                                <strong>Admin Verify status</strong>
                                                <br>
                                                @if($userdetails[0]->admin_verify_status == "1")
                                                    <span class="label label-lg label-info">Hold</span>
                                                @elseif($userdetails[0]->admin_verify_status == "2")
                                                    <span class="label label-lg label-success">Verified</span>
                                                @else
                                                    <span class="label label-lg label-danger">Not verified</span>
                                                @endif
                                            </div>
                                            <div class="col-md-3 col-6"> 
                                                <strong>Staff Verify status</strong>
                                                <br>
                                                @if($userdetails[0]->staff_verify_status == "1")
                                                    <span class="label label-lg label-info">Hold</span>
                                                @elseif($userdetails[0]->staff_verify_status == "2")
                                                    <span class="label label-lg label-success">Verified</span>
                                                @else
                                                    <span class="label label-lg label-danger">Not verified</span>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <h4 class="font-bold">User Note</h4>
                                        <hr>
                                        @if( $userdetails[0]->user_note == null || $userdetails[0]->user_note == "")
                                        
                                            <p class="m-t-30"> Not available </p>
                                        @else
                                            <p class="m-t-30">{{ $userdetails[0]->user_note }}</p>
                                        
                                        @endif
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

                                        <h4 class="font-bold">Introduction</h4>
                                        @if( $userdetails[0]->intro == null || $userdetails[0]->intro == "")
                                        
                                            <p class="m-t-30"> Not available </p>
                                        @else
                                            <p class="m-t-30">{{ $userdetails[0]->intro }}</p>
                                        
                                        @endif
                                        <hr>

                                        <h4 class="font-bold">Company introduction</h4>
                                        @if( $userdetails[0]->company_intro == null || $userdetails[0]->company_intro == "")
                                        
                                            <p class="m-t-30"> Not available </p>
                                        @else
                                            <p class="m-t-30">{{ $userdetails[0]->company_intro }}</p>
                                        
                                        @endif
                                        <hr>

                                        <h4 class="font-bold">Other Details</h4>
                                            <div class="row">
                                                <div class="col-md-4 col-6 b-r"> <strong>Investor Type</strong>
                                                    <br>
                                                    @if( $userdetails[0]->investortype == null || $userdetails[0]->investortype == "")
                                        
                                                        <p class="m-t-30"> Not available </p>
                                                    @else
                                                        <p class="m-t-30">{{ $userdetails[0]->investortype }} </p>

                                                    @endif
                                                </div>

                                                <div class="col-md-4 col-6 b-r"> <strong>Interest IN</strong>
                                                    <br>
                                                    @if( $userdetails[0]->interestin == null || $userdetails[0]->interestin == "")
                                        
                                                        <p class="m-t-30"> Not available </p>
                                                    @else
                                                        <p class="m-t-30">{{ $userdetails[0]->interestin }} </p>

                                                    @endif
                                                </div>

                                                <div class="col-md-4 col-6 b-r"> <strong>Designation</strong>
                                                    <br>
                                                    @if( $userdetails[0]->de_designation == null || $userdetails[0]->de_designation == "")
                                        
                                                        <p class="m-t-30"> Not available </p>
                                                    @else
                                                        <p class="m-t-30">{{ $userdetails[0]->de_designation }} INR</p>

                                                    @endif
                                                </div>

                                            </div>
                                        
                                            <div class="row">
                                                <div class="col-md-4 col-6 b-r"> <strong>Industry</strong>
                                                    <br>
                                                    @if( $userdetails[0]->industryname == null || $userdetails[0]->industryname == "")
                                        
                                                        <p class="m-t-30"> Not available </p>
                                                    @else
                                                        <p class="m-t-30">{{ $userdetails[0]->industryname }}</p>
                                                    @endif
                                                </div>

                                                

                                                

                                            </div>
                                        <hr>

                                        <h4 class="font-bold">Investment Details</h4>
                                        <div class="row">
                                            <div class="col-md-4 col-6 b-r"> <strong>Min Investment Amount</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->min_investment }} </p>
                                            </div>
                                            <div class="col-md-4 col-6 b-r"> <strong>Max Investment Amount</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->max_investment }}</p>
                                            </div>
                                            
                                        </div>
                                        <hr>


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