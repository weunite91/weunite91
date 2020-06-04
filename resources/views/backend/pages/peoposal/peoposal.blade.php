@extends('backend.layout.layout')
@section('content')

 <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Proposal List</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Proposal List</li>
                    </ol>
                </div>
            </div>
            
            <div class="row">
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-head">
                <header>Proposal List</header>
            </div>
            <div class="card-body">
            Action: <select id="allaction" name="allaction"  >
            <option value="" ></option>
           
            <option value="approve" >Approve</option>
            <option value="pending" >Pending</option>
            <option value="rejected" >Rejected</option>
            </select>
            <input type="button" value="Submit" id="allSubmit" />
            </div>
            <div class="card-body ">
                {{ csrf_field() }}
                
                <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" id="proposal-datatable">
                        <thead>
                            <tr>
                                <th class="center no-sort"><input type="checkbox" class="allcheckbox" /></th>
                                <th class="center">S.First Name</th>
                                <th class="center">S.Profile Code</th>
                                <th class="center">R.First Name</th>
                                <th class="center">R.Profile Code</th>
                                <th class="center">Subject</th>
                                <th class="center">Status</th>
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