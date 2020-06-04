@extends('backend.layout.layout')
@section('content')
@php
$imagearry = explode("," , $userdetails[0]->images_array);

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
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("staff-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="{{ route("pending-profile") }}">Pending Profile</a>&nbsp;<i class="fa fa-angle-right"></i>
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
                                            <div class="col-md-3 col-6 b-r"> <strong>Full Name</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->firstname }} {{ $userdetails[0]->lastname }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Mobile</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->country_code }} {{ $userdetails[0]->number }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Email</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->email }}</p>
                                            </div>
                                            <div class="col-md-3 col-6"> <strong>Location</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->city_name }},{{ $userdetails[0]->states_name }},{{ $userdetails[0]->c_name }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        
                                        <div class="row">
                                            <div class="col-md-3 col-6 b-r"> <strong>Ip Address </strong>
                                                <br>
                                                <span class="label label-lg ">{{ $userdetails[0]->ip }}</span>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Email Verify status</strong>
                                                <br>
                                                @if($userdetails[0]->verify_status == "1")
                                                    <span class="label label-lg label-success">Verified</span>
                                                
                                                @else
                                                    <span class="label label-lg label-danger">Not verified</span>
                                                
                                                @endif
                                               
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Admin Verify status</strong>
                                                <br>
                                                @if($userdetails[0]->admin_verify_status == "1")
                                                    <span class="label label-lg label-success">Verified</span>
                                                
                                                @else
                                                    <span class="label label-lg label-danger">Not verified</span>
                                                
                                                @endif
                                            </div>
                                            <div class="col-md-3 col-6"> <strong>Staff Verify status</strong>
                                                <br>
                                                @if($userdetails[0]->staff_verify_status == "1")
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
                                        
                                        <h4 class="font-bold">Investor Details</h4>
                                        <div class="row">
                                            <div class="col-md-4 col-6 b-r"> <strong>Min Investment Amount</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->min_investment }} </p>
                                            </div>
                                            <div class="col-md-4 col-6 b-r"> <strong>Max Investment Amount</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->max_investment }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 b-r"> <strong>Min Investment Accepated</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->min_investment_accepated }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        
                                        
                                        <h4 class="font-bold">USP Details</h4>
                                        <div class="row">
                                            <div class="col-md-3 col-6 b-r"> <strong>USP 1</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->usp1 }} </p>
                                            </div>
                                            
                                            <div class="col-md-3 col-6 b-r"> <strong>USP 2</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->usp2 }}</p>
                                            </div>
                                            
                                            <div class="col-md-3 col-6 b-r"> <strong>USP 3</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->usp3 }}</p>
                                            </div>
                                            
                                            <div class="col-md-3 col-6 b-r"> <strong>USP 4</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->usp4 }}</p>
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
                                        
                                        <h4 class="font-bold">Idea</h4>
                                        @if( $userdetails[0]->idea == null || $userdetails[0]->idea == "")
                                        
                                            <p class="m-t-30"> Not available </p>
                                        @else
                                            <p class="m-t-30">{{ $userdetails[0]->idea }}</p>
                                        
                                        @endif
                                        <hr>
                                        
                                        <h4 class="font-bold">Team Overview</h4>
                                        @if( $userdetails[0]->team == null || $userdetails[0]->team == "")
                                        
                                            <p class="m-t-30"> Not available </p>
                                        @else
                                            <p class="m-t-30">{{ $userdetails[0]->intro }}</p>
                                        
                                        @endif
                                        <hr>
                                        
                                        <h4 class="font-bold">Team</h4>
                                        <div class="row">
                                            <div class="col-md-3 col-6 b-r"> <strong>Team Member 1</strong>
                                                <br>
                                                @if( $userdetails[0]->team_mem1 == null || $userdetails[0]->team_mem1 == "")
                                                    <p class="text-muted">Not available </p>
                                                @else
                                                   <p class="text-muted">Name : {{ $userdetails[0]->team_mem1 }} <br>Designation :{{ $userdetails[0]->team_mem_deg1 }} </p>
                                                @endif
                                                
                                            </div>
                                            
                                            <div class="col-md-3 col-6 b-r"> <strong>Team Member 2</strong>
                                                <br>
                                                @if( $userdetails[0]->team_mem2 == null || $userdetails[0]->team_mem2 == "")
                                                    <p class="text-muted">Not available </p>
                                                @else
                                                   <p class="text-muted">Name : {{ $userdetails[0]->team_mem2 }} <br>Designation :{{ $userdetails[0]->team_mem_deg2 }} </p>
                                                @endif
                                            </div>
                                            
                                            <div class="col-md-3 col-6 b-r"> <strong>Team Member 3</strong>
                                                <br>
                                                @if( $userdetails[0]->team_mem3 == null || $userdetails[0]->team_mem3 == "")
                                                    <p class="text-muted">Not available </p>
                                                @else
                                                   <p class="text-muted">Name : {{ $userdetails[0]->team_mem3 }} <br>Designation :{{ $userdetails[0]->team_mem_deg3 }} </p>
                                                @endif
                                            </div>
                                            
                                            <div class="col-md-3 col-6 b-r"> <strong>Team Member 4</strong>
                                                <br>
                                                @if( $userdetails[0]->team_mem4 == null || $userdetails[0]->team_mem4 == "")
                                                    <p class="text-muted">Not available </p>
                                                @else
                                                   <p class="text-muted">Name : {{ $userdetails[0]->team_mem4 }} <br>Designation :{{ $userdetails[0]->team_mem_deg4 }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        
                                        <h4 class="font-bold">Financial KPI</h4>
                                            <div class="row">
                                                <div class="col-md-4 col-6 b-r"> <strong>Return of Investment</strong>
                                                    <br>
                                                    @if( $userdetails[0]->roi == null || $userdetails[0]->roi == "")
                                        
                                                        <p class="m-t-30"> Not available </p>
                                                    @else
                                                        <p class="m-t-30">{{ $userdetails[0]->roi }} %</p>

                                                    @endif
                                                </div>

                                                <div class="col-md-4 col-6 b-r"> <strong>Cost of Capital</strong>
                                                    <br>
                                                    @if( $userdetails[0]->cop == null || $userdetails[0]->cop == "")
                                        
                                                        <p class="m-t-30"> Not available </p>
                                                    @else
                                                        <p class="m-t-30">{{ $userdetails[0]->cop }} %</p>

                                                    @endif
                                                </div>

                                                <div class="col-md-4 col-6 b-r"> <strong>Promotions Investment</strong>
                                                    <br>
                                                    @if( $userdetails[0]->pi == null || $userdetails[0]->pi == "")
                                        
                                                        <p class="m-t-30"> Not available </p>
                                                    @else
                                                        <p class="m-t-30">{{ $userdetails[0]->pi }} INR</p>

                                                    @endif
                                                </div>

                                            </div>
                                        
                                            <div class="row">
                                                <div class="col-md-4 col-6 b-r"> <strong>Assured Minimum Dividend</strong>
                                                    <br>
                                                    @if( $userdetails[0]->dividend == null || $userdetails[0]->dividend == "")
                                        
                                                        <p class="m-t-30"> Not available </p>
                                                    @else
                                                        <p class="m-t-30">{{ $userdetails[0]->dividend }} %</p>
                                                    @endif
                                                </div>

                                                <div class="col-md-4 col-6 b-r"> <strong>Fixed Assests</strong>
                                                    <br>
                                                    @if( $userdetails[0]->fa == null || $userdetails[0]->fa == "")
                                        
                                                        <p class="m-t-30"> Not available </p>
                                                    @else
                                                        <p class="m-t-30">{{ $userdetails[0]->fa }} INR</p>
                                                    @endif
                                                </div>

                                                <div class="col-md-4 col-6 b-r"> <strong>Ebitda</strong>
                                                    <br>
                                                    @if( $userdetails[0]->ebitda == null || $userdetails[0]->ebitda == "")
                                        
                                                        <p class="m-t-30"> Not available </p>
                                                    @else
                                                        <p class="m-t-30">{{ $userdetails[0]->ebitda }} %</p>
                                                    @endif
                                                </div>

                                            </div>
                                        <hr>
                                        
                                        
                                        <h4 class="font-bold">Images and Video</h4>
                                            <div class="row">
                                                <div class="col-md-6 col-6 b-r"> <strong>Team Member Images</strong>
                                                    <br>
                                                    @if( $userdetails[0]->member_image == null || $userdetails[0]->member_image == "")
                                                        <img class="img-responsive" style="width:350px; height:200px "src="{{ asset('public/frontend/image/no-image.png') }}" >
                                                        <!--<p class="m-t-30"> Not available </p>-->
                                                    @else
                                                        <img class="img-responsive" style="width:350px; height:200px "src="{{ asset('public/backend/assets/upload/team_member'. $userdetails[0]->member_imageuser.jpg) }}" >
                                                    @endif
                                                </div>

                                                <div class="col-md-6 col-6 b-r"> <strong>Video</strong>
                                                    <br>
                                                    @if( $userdetails[0]->video == null || $userdetails[0]->video == "")
                                                        <img class="img-responsive" style="width:350px; height:200px "src="{{ asset('public/frontend/image/no-video.jpg') }}" >
                                                    @else
                                                        <p class="m-t-30">{{ $userdetails[0]->video }} %</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                        
                                         <h4 class="font-bold">Company Images</h4>
                                            <div class="row">
                                                @if( count($imagearry) == 0)
                                                    <div class="col-md-3 col-3 b-r"> 
                                                            <img class="img-responsive" style="width:350px; height:200px "src="{{ asset('public/frontend/image/no-image.png') }}" >
                                                    </div>
                                                    
                                                @else
                                                    @for($i = 0; $i < count($imagearry) ; $i++)
                                                        <div class="col-md-3 col-3 b-r"> 
                                                            <img class="img-responsive" style="width:350px; height:200px "src="{{ asset('public/upload/company_details/'.$imagearry[$i]) }}" >
                                                        </div>
                                                    @endfor
                                                @endif
                                                
                                            </div>
                                            <hr>
                                        
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
                                            <div class="col-md-3 col-6 b-r"> <strong>Payment No</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->payment_no }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Payment Amount</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->amount }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Plan Name</strong>
                                                <br>
                                                <p class="text-muted">{{ $userdetails[0]->planname }}</p>
                                            </div>
                                            <div class="col-md-3 col-6"> <strong>Plan Status</strong>
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