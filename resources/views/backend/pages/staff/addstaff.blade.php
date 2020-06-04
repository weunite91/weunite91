@extends('backend.layout.layout')
@section('content')

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
                        <li class="active">Add Staff</li>
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
                                    <form method="post" id='addform'>{{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-6">
                                               <div class="form-group">
                                                    <label for="simpleFormEmail">First name</label>
                                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter first name">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">Last name</label>
                                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter last name">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email address">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <label for="simpleFormEmail">Phone Number</label>
                                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Enter phone number">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                               <div class="form-group">
                                                    <label for="simpleFormEmail">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">Confirm Password</label>
                                                    <input type="password" class="form-control" id="lastname" name="cpassword" placeholder="Enter confirm password">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">Asign Role</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary submitbtn">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
        </div>
    </div>
    <!-- end page content -->

@endsection
