@extends('backend.layout.layout')
@section('content')
<!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Edit Proposal</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Edit Proposal</li>
                    </ol>
                </div>
            </div>
            
           <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Edit Proposal</header>
                                        
                                </div>
                                <div class="card-body " id="bar-parent">
                                    <form action="" method="post" id='editform-proposal' enctype="multipart/form-data">{{ csrf_field() }}
                                        
                                        <input type="text" class="form-control hidden" id="editid" name="editid" value="" placeholder="Enter first name">
                                        
                                        <div class="row">
                                            <div class="col-6">
                                               <div class="form-group">
                                                    <label for="simpleFormEmail">Sender First name</label>
                                                    <input type="text" class="form-control" readonly id="firstname" name="firstname" value="{{$details[0]->sender_firstname}}" placeholder="Enter first name">
                                                </div> 
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">Sender Profile Code</label>
                                                    <input type="text" class="form-control" readonly id="profilecode" name="profilecode" value="{{$details[0]->sender_profile_code}}" placeholder="Enter user profile code">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                               <div class="form-group">
                                                    <label for="simpleFormEmail">Receiver First name</label>
                                                    <input type="text" class="form-control" readonly id="firstname" name="firstname" value="{{$details[0]->rev_firstname}}" placeholder="Enter first name">
                                                </div> 
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">Receiver Profile Code</label>
                                                    <input type="text" class="form-control" readonly id="profilecode" name="profilecode" value="{{$details[0]->rec_profile_code}}" placeholder="Enter user profile code">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">Subject</label>
                                                    <input type="text" class="form-control" id="subject" name="subject" value="{{$details[0]->subject}}" placeholder="Enter user subject">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">Message</label>
                                                    <textarea name="message" class="form-control" placeholder="Enter user message">{{$details[0]->message}}</textarea>
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