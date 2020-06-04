@extends('backend.layout.layout')
@section('content')

 <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">KPI Support Request</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">KPI Support Request</li>
                    </ol>
                </div>
            </div>
            
            <div class="row">
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-head">
                <header>KPI Support Request List</header>
            </div>
            <div class="card-body ">
                {{ csrf_field() }}
                
                <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" id="request-datatable">
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th class="center">Name</th>
                               
                                <th class="center">Email</th>
                                <th class="center">Profile Code</th>
                                <th class="center">Message</th>
                                <th class="center">Created At</th>
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