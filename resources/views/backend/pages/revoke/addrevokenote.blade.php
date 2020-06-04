@extends('backend.layout.layout')
@section('content')

 <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Add Revoke Note</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("admin-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Add Revoke Note</li>
                    </ol>
                </div>
            </div>
            
            <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Add Revoke Note</header>
                                        
                                </div>
                                <div class="card-body " id="bar-parent">
                                    <form method="post" id="addrevokenotform">{{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-12">
                                               <div class="form-group">
                                                    <label for="simpleFormEmail">Revoke Note</label>
                                                    <textarea class="form-control" name="revokenote" id="revokenote">{{ $revokenote[0]->note != null ? $revokenote[0]->note : '' }}</textarea>
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