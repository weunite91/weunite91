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
    <!-- end page content -->

   
@endsection