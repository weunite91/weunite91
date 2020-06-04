@extends('backend.layout.layout')
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Proposal Details</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="{{ route("all-users") }}">All Users</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Proposal Details</li>
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
                                    <li class="nav-item tab-all"><a class="nav-link active show" href="#tab1" data-toggle="tab">Sender Details</a></li>
                                    <li class="nav-item tab-all p-l-20"><a class="nav-link" href="#tab2" data-toggle="tab">Receiver Details</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="white-box">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active fontawesome-demo" id="tab1">
                                    <div id="biography" >
                                        <h4 class="font-bold">Sender Details</h4>
                                        <div class="row">
                                            <div class="col-md-12 col-12 b-r"> <strong>Sender Name : {{ $details[0]['sender_firstname'] }}</strong>
                                            </div>
                                            <div class="col-md-12 col-12 b-r"> <strong>Sender Profile Code : {{ $details[0]['sender_profile_code'] }}</strong>
                                            </div>
                                            <div class="col-md-12 col-12 b-r"> <strong>Subject : {{ $details[0]['subject'] }}</strong>
                                            </div>
                                            <div class="col-md-12 col-12"> <strong>Message : {{ $details[0]['message'] }}</strong>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                
                                
                                <div class="tab-pane" id="tab2">
                                    <div id="biography" >
                                        
                                        <h4 class="font-bold">Receiver Details</h4>
                                        <div class="row">
                                            <div class="col-md-12 col-12 b-r"> <strong>Receiver Name : {{ $details[0]['rev_firstname'] }}</strong>
                                            </div>
                                            <div class="col-md-12 col-12 b-r"> <strong>Receiver Profile Code : {{ $details[0]['rec_profile_code'] }}</strong>
                                            </div>
                                        </div>
                                        <hr>
                                        
                                    </div>
                                </div>
                                
                                <div class="tab-pane" id="tab3">
                                    <div id="biography" >
                                        
                                        <div class="row profilecoderow">
                                            <div class="col-md-6 col-6 b-r"> <strong>User Profile Code</strong>
                                                <br>
                                                <span class="label label-lg label-success "></span>
                                            </div>
                                            
                                            
                                            <div class="col-md-6 col-6 b-r "> <strong>User Type</strong>
                                                <br>
                                                <span class="label label-lg label-danger"></span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-3 col-6 b-r"> <strong>Payment No</strong>
                                                <br>
                                                <p class="text-muted"></p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Payment Amount</strong>
                                                <br>
                                                <p class="text-muted"></p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Plan Name</strong>
                                                <br>
                                                <p class="text-muted"></p>
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
@endsection