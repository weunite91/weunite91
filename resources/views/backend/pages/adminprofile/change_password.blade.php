@extends('backend.layout.layout')
@section('content')

<!-- start page content -->
<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Change Password</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                
                                <li class="active">Change Password</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-12 col-sm-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Change Password</header>
                                    <button id = "panel-button2" 
				                           class = "mdl-button mdl-js-button mdl-button--icon pull-right" 
				                           data-upgraded = ",MaterialButton">
				                           <i class = "material-icons">more_vert</i>
				                        </button>
				                        <ul class = "mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
				                           data-mdl-for = "panel-button2">
				                           <li class = "mdl-menu__item"><i class="material-icons">assistant_photo</i>Action</li>
				                           <li class = "mdl-menu__item"><i class="material-icons">print</i>Another action</li>
				                           <li class = "mdl-menu__item"><i class="material-icons">favorite</i>Something else here</li>
				                        </ul>
                                </div>
                                <div class="card-body " id="bar-parent1">
                                	{{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'change_password' )) }}
                                        <div class="form-group row">
                                            <label for="firstname" class="col-sm-3 control-label">New Password</label>
                                            <div class="col-sm-9">
                                                <!-- <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"> -->
                                                {{ Form::text('new_password', '', array('class' => 'form-control','placeholder'=>'New Password', 'id'=>'newpassword', 'minlength'=>'3')) }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="lastname" class="col-sm-3 control-label">Confirm New Password</label>
                                            <div class="col-sm-9">
                                                <!-- <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name"> -->
                                                {{ Form::text('confirm_new_password', '', array('class' => 'form-control','minlength'=>'3','placeholder'=>'Confirm New Password')) }}
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