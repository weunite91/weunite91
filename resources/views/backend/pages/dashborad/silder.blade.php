@extends('backend.layout.layout')
@section('content')

<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Slider</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Slider</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Staff List</header>
                    </div>
                    <div class="card-body ">
                        {{ csrf_field() }}
                        <div class="row p-b-20 pull-right">
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="btn-group">
                                    <a href="{{ route('add-silder') }}" id="addRow" class="btn btn-info">
                                        Add New Slider <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-scrollable">
                            <table class="table table-hover table-checkable order-column full-width" id="staffloist-datatable">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th class="center">Profile Code</th>
                                        <th class="center">First Name</th>
                                        <th class="center">Last Name</th>
                                        <th class="center">Email</th>
                                        <th class="center">Phone Number</th>
                                        <th class="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page content -->

@endsection