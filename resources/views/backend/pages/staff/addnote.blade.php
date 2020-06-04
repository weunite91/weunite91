@extends('backend.layout.layout')
@section('content')
@php
    if($userdetalis[0]->roles == "I"){
        $usertype = 'Investor';
    }
    
    if($userdetalis[0]->roles == "FR"){
        $usertype = 'Fund Raiser';
    }
    
    if($userdetalis[0]->roles == "F"){
        $usertype = 'Franchise';
    }
    
    if($userdetalis[0]->roles == "P"){
        $usertype = 'Partners';
    }
    
@endphp
 <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Add User Note</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Add User Note</li>
                    </ol>
                </div>
            </div>
            
            <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Add User Note</header>
                                        
                                </div>
                                <div class="card-body " id="bar-parent">
                                    <form method="post" id="addusernotform">{{ csrf_field() }}
                                        
                                        <div class="row"><input type="text" class="form-control hidden" id="editid" name="editid" value="{{ $userdetalis[0]->id }}" placeholder="Enter User Type" readonly>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">User Type</label>
                                                    <input type="text" class="form-control" id="usertype" name="usertype" value="{{ $usertype }}" placeholder="Enter User Type" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">Profile Code</label>
                                                    <input type="text" class="form-control" value="{{ $userdetalis[0]->profile_code }}" id="profile_code" name="profile_code" placeholder="Enter Profile Code" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-6">
                                               <div class="form-group">
                                                    <label for="simpleFormEmail">First name</label>
                                                    <input type="text" class="form-control" value="{{ $userdetalis[0]->firstname }}" id="firstname" name="firstname" placeholder="Enter first name" readonly>
                                                </div> 
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">Last name</label>
                                                    <input type="text" class="form-control" id="lastname" value="{{ $userdetalis[0]->lastname }}" name="lastname" placeholder="Enter last name" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                               <div class="form-group">
                                                    <label for="simpleFormEmail">User Note</label>
                                                    <textarea class="form-control" name="usernote" id="usernote">{{ $userdetalis[0]->user_note }}</textarea>
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