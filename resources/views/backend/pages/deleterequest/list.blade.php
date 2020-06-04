@extends('backend.layout.layout')
@section('content')

 <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Delete Profile Request</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Delete Profile Request</li>
                    </ol>
                </div>
            </div>
            
            <div class="row">
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-head">
                <header>Delete Profile Request</header>
            </div>
            <div class="card-body ">
                {{ csrf_field() }}
                <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" id="delete-request-datatable">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">User Type</th>
                                <th class="center">Profile Code</th>
                                <th class="center">First Name</th>
                                <th class="center">Last Name</th>
                                <th class="center">Email</th>
                                <th class="center">Phone Number</th>
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
<div id="apporverrequest" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Approve Request</h3>
                        Are you sure want to approve request ?<br/>
                        <form role="form">
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-l" style="margin: 10px;"data-dismiss="modal">Cancel</button>
                                <button class="btn btn-sm btn-danger pull-right yes-sure-apporverrequest m-l" style="margin: 10px;"  type="button"><strong><i class="fa fa-trash"></i> Delete </strong></button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
    <!-- end page content -->
<div id="declienrequest" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Decline Request</h3>
                        Are You sure want to decline request ?<br/>
                        <form role="form">
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-l" style="margin: 10px;"data-dismiss="modal">Cancel</button>
                                <button class="btn btn-sm btn-danger pull-right yes-sure-declienrequest m-l" style="margin: 10px;"  type="button"><strong><i class="fa fa-trash"></i> Delete </strong></button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection