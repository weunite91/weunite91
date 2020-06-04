@extends('backend.layout.layout')
@section('content')

<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Fund Raiser Pending Approval</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Fund Raiser Pending Approval</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Fund Raiser Pending Approval List</header>
                    </div>
                    <div class="card-body ">
                        {{ csrf_field() }}
                        <div class="table-scrollable">
                            <table class="table table-hover table-checkable order-column full-width" id="fr-Pending-datatable">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th class="center">Name</th>
                                        <!--<th class="center">Type</th>-->
                                        <th class="center">Profilecode</th>

                                        <th class="center">Created date</th>
                                        <th class="center">IP</th>
                                        <th class="center">Email</th>
                                        <th class="center">Allocted</th>
                                        <th class="center">C.T</th>

                                        <th class="center">Admin Verify</th>

                                        <th class="center">Email verify</th>
                                        <th class="center">Staff Verify</th>
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
