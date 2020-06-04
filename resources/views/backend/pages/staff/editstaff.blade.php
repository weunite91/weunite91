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