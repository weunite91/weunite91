@extends('backend.layout.layout')
@section('content')

 <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Verify Address</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Verify Address</li>
                    </ol>
                </div>
            </div>
            
            <div class="row">
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-head">
                <header>Verify Address</header>
            </div>
            <div class="card-body ">
                {{ csrf_field() }}
                <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" 
                    id="verifyaddress-datatable">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">Name</th>
                              
                                <th class="center">Profilecode</th>                                                  
                                <th class="center">Email</th>
                                <th class="center">Address</th>
                                <th class="center">City</th>
                                <th class="center">State</th>
                                 <th class="center">Country</th> 
                                <th class="center">Pincode</th>
                                
                                
                                <th class="center">Status</th>
                                <th class="center">Amount</th>
                                <th class="center">Txn Id</th>
                                
                               
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