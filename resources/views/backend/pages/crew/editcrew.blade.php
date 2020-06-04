@extends('backend.layout.crew_layout')
@section('content')
@php

    if($staffdetails[0]->asign_role){
        $role = json_decode($staffdetails[0]->asign_role) ;
    }else{
        $role = [];
    }

@endphp
 <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Staff List</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="{{ route("admin-dashborad") }}">Staff List</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                        <li class="active">Edit Staff</li>
                    </ol>
                </div>
            </div>

           <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Add Staff</header>

                                </div>
                                <div class="card-body " id="bar-parent">
                                    <form method="post" id='editform'>{{ csrf_field() }}

                                        <input type="text" class="form-control hidden" id="editid" name="editid" value="{{ $staffdetails[0]->id }}" placeholder="Enter first name">

                                        <div class="row">
                                            <div class="col-6">
                                               <div class="form-group">
                                                    <label for="simpleFormEmail">First name</label>
                                                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $staffdetails[0]->firstname }}" placeholder="Enter first name">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">Last name</label>
                                                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $staffdetails[0]->lastname }}" placeholder="Enter last name">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email" value="{{ $staffdetails[0]->email }}" placeholder="Enter email address">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <label for="simpleFormEmail">Phone Number</label>
                                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="{{ $staffdetails[0]->number }}" placeholder="Enter phone number">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password"  placeholder="Enter staff password">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <label for="simpleFormEmail">Confirm Password</label>
                                                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"  placeholder="Enter confirm password">
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">Asign Role</label>

                                                        <div class="col-12">
                                                            <div class="row">
                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="mono" id="mono" type="checkbox" {{  in_array("mono", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Mobile Number</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="email" id="email" type="checkbox" {{  in_array("email", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Email</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="userNote" id="userNote" type="checkbox" {{  in_array("userNote", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">User Note</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="MINIA" id="MINIA" type="checkbox" {{  in_array("MINIA", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Minimun Investment Amount</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="MAXIA" id="MAXIA" type="checkbox" {{  in_array("MAXIA", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Maximum Investment Amount</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="MINAI" id="MINAI" type="checkbox" {{  in_array("MINAI", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Minimun Investment Accepted</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="USP" id="USP" type="checkbox" {{  in_array("USP", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">USP</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="intro" id="intro" type="checkbox" {{  in_array("intro", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Introduction</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="idea" id="idea" type="checkbox" {{  in_array("idea", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Idea</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="TO" id="TO" type="checkbox" {{  in_array("TO", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Team Overview</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="team" id="team" type="checkbox" {{  in_array("team", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Team</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="video" id="video" type="checkbox" {{  in_array("video", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Video</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="mi" id="mi" type="checkbox" {{  in_array("mi", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Members Image</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="ci" id="ci" type="checkbox" {{  in_array("ci", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Company Image</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="kpi" id="kpi" type="checkbox" {{  in_array("kpi", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">KPI Details</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="pd" id="payment" type="checkbox" {{  in_array("pd", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Payment Details</label>
                                                            </div>


                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="view" id="view" type="checkbox" {{  in_array("view", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">View</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="edit" id="edit" type="checkbox" {{  in_array("edit", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Edit</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="addNote" id="addNote" type="checkbox" {{  in_array("addNote", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Add Note</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="status" id="status" type="checkbox" {{  in_array("status", $role) ? 'checked="checked"' : '' }} >
                                                                <label for="checkbox1">Status Log</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="slider" id="slider" type="checkbox" {{  in_array("slider", $role) ? 'checked="checked"' : '' }}>
                                                                <label for="checkbox1">Slider</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="sv" id="sv" type="checkbox" {{  in_array("sv", $role) ? 'checked="checked"' : '' }}>
                                                                <label for="checkbox1">Staff Verify</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="image" id="image" type="checkbox" {{  in_array("image", $role) ? 'checked="checked"' : '' }}>
                                                                <label for="checkbox1">Image Delete</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="video" id="video" type="checkbox" {{  in_array("video", $role) ? 'checked="checked"' : '' }}>
                                                                <label for="checkbox1">Video Delete</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3" >
                                                                <input name="role[]" value="emailImages" id="emailImages" type="checkbox" {{  in_array("emailImages", $role) ? 'checked="checked"' : '' }}>
                                                                <label for="checkbox1">Email Image</label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
        </div>
    </div>
    <!-- end page content -->

@endsection
