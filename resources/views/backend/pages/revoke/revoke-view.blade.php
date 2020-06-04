@extends('backend.layout.layout')
@section('content')

<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Revoke Details</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Revoke Details</li>
                </ol>
            </div>
        </div>

     
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="profile-content">
                        <div class="row">
                            <div class="profile-tab-box">
                                <div class="p-l-20">
                                    <ul class="nav ">
                                        <li class="nav-item tab-all"><a
                                                class="nav-link active show" href="#tab1" data-toggle="tab">Fund Raiser Details</a></li>
                                        <li class="nav-item tab-all p-l-20"><a class="nav-link"
                                                                               href="#tab2" data-toggle="tab">Investor Details</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="white-box">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active fontawesome-demo" id="tab1">
                                        <div id="biography" >

                                            <div class="row">
                                                <div class="col-md-6 col-6 b-r"> <strong>User Profile Code</strong>
                                                    <br>
                                                    <span class="label label-lg label-success ">{{ $detailsfr[0]->profile_code }}</span>
                                                </div>


                                                <div class="col-md-6 col-6 b-r "> <strong>User Type</strong>
                                                    <br>
                                                    <span class="label label-lg label-danger">Fund Raiser</span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3 col-6 b-r"> <strong>Full Name</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $detailsfr[0]->firstname }} {{ $detailsfr[0]->lastname }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>Mobile</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $detailsfr[0]->number }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>Email</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $detailsfr[0]->email }}</p>
                                                </div>
                                                <div class="col-md-3 col-6"> <strong>Location</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $detailsfr[0]->cityname }},{{ $detailsfr[0]->statename }},{{ $detailsfr[0]->countryname }}</p>
                                                </div>
                                            </div>
                                            <hr>

                                        </div>
                                    </div>
                                    
                                    
                                    <div class="tab-pane  fontawesome-demo" id="tab2">
                                        <div id="biography" >

                                            <div class="row">
                                                <div class="col-md-6 col-6 b-r"> <strong>User Profile Code</strong>
                                                    <br>
                                                    <span class="label label-lg label-success ">{{ $detailsinvestor[0]->profile_code }}</span>
                                                </div>


                                                <div class="col-md-6 col-6 b-r "> <strong>User Type</strong>
                                                    <br>
                                                    <span class="label label-lg label-danger">Investor</span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3 col-6 b-r"> <strong>Full Name</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $detailsinvestor[0]->firstname }} {{ $detailsinvestor[0]->lastname }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>Mobile</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $detailsinvestor[0]->number }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>Email</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $detailsinvestor[0]->email }}</p>
                                                </div>
                                                <div class="col-md-3 col-6"> <strong>Location</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $detailsinvestor[0]->cityname }},{{ $detailsinvestor[0]->statename }},{{ $detailsinvestor[0]->countryname }}</p>
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
</div>
<!-- end page content -->

@endsection