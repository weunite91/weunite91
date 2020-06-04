@extends('backend.layout.crew_layout')
@section('content')

 <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Crew List</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Crew List</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-box">
                        <input type="hidden" id="staffId" value="{{  $id }}">
                        <div class="card-head">
                            <header>User Allocation</header>
                        </div>
                        <div class="card-body ">
                            {{ csrf_field() }}
                            <div class="table-scrollable">
                                <table class="table table-hover table-checkable order-column full-width" id="user-allocattion-datatable">
                                    <thead>
                                        <tr>
                                            <th class="center"><input type="checkbox" class="allusercheckbox" data-type="uncheck" name="usercheckbox" id="usercheckbox"></th>
                                            <th class="center">Profile Code</th>
                                            <th class="center">First Name</th>
                                            <th class="center">Last Name</th>
                                            <th class="center">Email</th>
                                            <th class="center">Phone Number</th>
                                            <th class="center">Alocation Date-time</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="table-scrollable">
                                <div class="col-12">
                                <div class="row">
                                    <select class="form-control col-3" id="selectMember" style="margin: 5px">
                                        <option value="">Select Crew Memeber</option>
                                        @foreach($stafflist as $key => $value)
                                            <option value="{{  $value->id }}">{{  $value->firstname }} {{  $value->lastname }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-primary col-3" data-staffid="{{ $id }}" id="btnChangeAllocate" style="margin: 5px"> Change Allocate User</button>
                                    <button type="button" class="btn btn-danger col-3" data-staffid="{{ $id }}" id="btnRemoveAllocate" style="margin: 5px"> Remove Allocate User</button>
                                </div>
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
