@extends('backend.layout.layout')
@section('content')

<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Admin Profile</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>

                    <li class="active">Admin Profile</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Update Details</header>
                        
                    </div>
                    <div class="card-body " id="bar-parent1">
                        {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'admin_profile_form' )) }}
                        <div class="form-group row">
                            <label for="firstname" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-10">
                                <!-- <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"> -->
                                {{ Form::text('firstname', $detail->firstname, array('class' => 'form-control','placeholder'=>'First Name' ,'required')) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-10">
                                <!-- <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name"> -->
                                {{ Form::text('lastname', $detail->lastname, array('class' => 'form-control','placeholder'=>'Last Name' ,'required')) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <!-- <input type="email" class="form-control" id="email" name="email" placeholder="Email"> -->
                                {{ Form::email('email', $detail->email, array('class' => 'form-control','placeholder'=>'Email' ,'required')) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contactno" class="col-sm-2 control-label">Contact No.</label>
                            <div class="col-sm-10">
                                <!-- <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Contact Number"> -->
                                {{ Form::text('contactno', $detail->number, array('class' => 'form-control','placeholder'=>'Contact Number' ,'required')) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="userimage" class="col-sm-2 control-label">Profile Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="userimage" name="userimage" placeholder="Profile Image">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="offset-md-3 col-md-9">
                                <button type="submit" class="btn btn-info">Submit</button>
                                <button type="button" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page content -->
@endsection