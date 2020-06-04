@extends('backend.layout.layout')
@section('content')

<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Cold User</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Cold Users</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Cold User</header>
                    </div>
                    <div class="card-body ">
                        {{ csrf_field() }}
                        <div class="table-scrollable">
                            <table class="table table-hover table-checkable order-column full-width" id="cold-user-datatable">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="allusercheckbox" data-type="uncheck" name="usercheckbox" id="usercheckbox"></th>
                                        <th>Name</th>
                                        <th>Profile code</th>
                                        <th>Created date</th>
                                        <th>Email</th>
                                        <th>Allocated</th>
                                        <th>Last login <br>date/time</th>
                                        <th>Cold date time</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="table-scrollable">
                            <div class="col-12">
                            <div class="row">                                
                                <button type="button" class="btn btn-danger col-3" data-id="{{ $id }}" id="btnRemoveAllocate" style="margin: 5px"> Remove from cold</button>
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


