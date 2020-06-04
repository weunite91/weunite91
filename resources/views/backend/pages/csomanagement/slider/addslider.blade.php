@extends('backend.layout.layout')
@section('content')

<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Add Slider</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("cso-dashborad") }}">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>

                    <li class="active">Add Slider</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Add Slider</header>
                    </div>
                    <div class="card-body " id="bar-parent1">
                        {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'add_slider' )) }}

                        <div class="form-group row">
                            <label for="userimage" class="col-sm-2 control-label">Profile Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="slider" name="slider" placeholder="Profile Image">
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
