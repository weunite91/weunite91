@extends('backend.layout.crew_layout')
@section('content')

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
                                    <form method="post" id='addform' >@csrf
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

                                                        <div class="col-12">
                                                            <div class="row">
                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="mono" id="mono" type="checkbox">
                                                                <label for="checkbox1">Mobile Number</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="email" id="email" type="checkbox">
                                                                <label for="checkbox1">Email</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="userNote" id="userNote" type="checkbox">
                                                                <label for="checkbox1">User Note</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="MINIA" id="MINIA" type="checkbox">
                                                                <label for="checkbox1">Minimun Investment Amount</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="MAXIA" id="MAXIA" type="checkbox">
                                                                <label for="checkbox1">Maximum Investment Amount</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="MINAI" id="MINAI" type="checkbox">
                                                                <label for="checkbox1">Minimun Investment Accepted</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="USP" id="USP" type="checkbox">
                                                                <label for="checkbox1">USP</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="intro" id="intro" type="checkbox">
                                                                <label for="checkbox1">Introduction</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="idea" id="idea" type="checkbox">
                                                                <label for="checkbox1">Idea</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="TO" id="TO" type="checkbox">
                                                                <label for="checkbox1">Team Overview</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="team" id="team" type="checkbox">
                                                                <label for="checkbox1">Team</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="video" id="video" type="checkbox">
                                                                <label for="checkbox1">Video</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="mi" id="mi" type="checkbox">
                                                                <label for="checkbox1">Members Image</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="ci" id="ci" type="checkbox">
                                                                <label for="checkbox1">Company Image</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="kpi" id="kpi" type="checkbox">
                                                                <label for="checkbox1">KPI Details</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="pd" id="payment" type="checkbox">
                                                                <label for="checkbox1">Payment Details</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="view" id="view" type="checkbox">
                                                                <label for="checkbox1">View</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="edit" id="edit" type="checkbox">
                                                                <label for="checkbox1">Edit</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="addNote" id="addNote" type="checkbox">
                                                                <label for="checkbox1">Add Note</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="status" id="status" type="checkbox">
                                                                <label for="checkbox1">Status Log</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="slider" id="slider" type="checkbox">
                                                                <label for="checkbox1">Slider</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="sv" id="sv" type="checkbox">
                                                                <label for="checkbox1">Staff Verify</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="image" id="image" type="checkbox">
                                                                <label for="checkbox1">Image Delete</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="video" id="video" type="checkbox">
                                                                <label for="checkbox1">Video Delete</label>
                                                            </div>

                                                            <div class="checkbox checkbox-icon-black p-0 col-3">
                                                                <input name="role[]" value="emailImages" id="emailImages" type="checkbox">
                                                                <label for="checkbox1">Email Image</label>
                                                            </div>



                                                        </div>
                                                    </div>
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
