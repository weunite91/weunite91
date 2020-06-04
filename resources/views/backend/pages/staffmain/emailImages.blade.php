@extends('backend.layout.layout')
@section('content')

<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Add email template Image</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>

                    <li class="active">Add email template Image</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Add email template Image</header>
                    </div>
                    <div class="card-body " id="bar-parent1">
                        {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'add_email_image' )) }}
                        
                        <div class="form-group row">
                            <label for="userimage" class="col-sm-2 control-label">Image Name :</label>
                            <div class="col-sm-10"> 
                                <label for="userimage" class="col-sm-2 control-label"> {{  $emailimage[0]->imagename }}</label>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="userimage" class="col-sm-2 control-label">Added By :</label>
                            <div class="col-sm-10"> 
                                <label for="userimage" class="col-sm-2 control-label"> {{  $emailimage[0]->firstname }}  {{  $emailimage[0]->lastname }} </label>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="userimage" class="col-sm-2 control-label">Image:</label>
                            <div class="col-sm-10"> 
                                <img src="{{ asset('public/upload/emailImages/'.$emailimage[0]->imagename ) }}" >
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="oldfile" name="oldfile" value="{{  $emailimage[0]->imagename }}">
                        <div class="form-group row">
                            <label for="userimage" class="col-sm-2 control-label">Email template image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="add_email_image" name="add_email_image" placeholder="Email template image">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="userimage" class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-info submitbtn">Add Image</button>
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