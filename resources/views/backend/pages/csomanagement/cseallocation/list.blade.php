@extends('backend.layout.layout')
@section('content')

 <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">CSE Allocation List</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("cso-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">CSE Allocation List</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-box">
                        <div class="card-head">
                            <header>CSE Allocation List</header>
                        </div>
                        <div class="card-body ">
                            {{ csrf_field() }}
                            <div class="table-scrollable">
                                <table class="table table-hover table-checkable order-column full-width" id="cse-allocattion-cso-datatable">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th class="center">Profile Code</th>
                                            <th class="center">First Name</th>
                                            <th class="center">Last Name</th>
                                            <th class="center">Email</th>
                                            <th class="center">Phone Number</th>
                                            <th class="center">Allocation <br> Date Time</th>
                                            <th class="center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->

@endsection
