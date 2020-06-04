@extends('backend.layout.layout')
@section('content')

 <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">All Payment Details</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">All Payment Details</li>
                    </ol>
                </div>
            </div>
            
            <div class="row">
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-head">
                <header>All Payment Details List</header>
            </div>
            <div class="card-body ">
                {{ csrf_field() }}
                
                <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" id="allpayment-datatable">
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th class="center">Name</th>
                                <th class="center">Profile Code</th>
                                <th class="center">Transaction ID</th>
                                <th class="center">Paid Amount</th>
                                <th class="center">Investment/Package</th>
                                <th class="center">Date</th>
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