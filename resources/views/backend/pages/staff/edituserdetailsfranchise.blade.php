@extends('backend.layout.layout')
@section('content')
@php


if($userdetails[0]->roles == "A"){
    $usertype = 'Admin';
}

if($userdetails[0]->roles == "S"){
    $usertype = 'Staff';
}


if($userdetails[0]->roles == "FR"){
    $usertype = 'Fund Raiser';
}


if($userdetails[0]->roles == "F"){
    $usertype = 'Franchise';
}

if($userdetails[0]->roles == "P"){
    $usertype = 'Partner';
}

if($userdetails[0]->roles == "I"){
    $usertype = 'Investor';
}

@endphp
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Franchise Edit Details</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route("staff-dashborad") }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="{{ route("pending-profile") }}">Pending Profile</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Franchise Edit Details</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="profile-tab-box">
                            <div class="p-l-20">
                                <ul class="nav ">
                                    <li class="nav-item tab-all">
                                        <a class="nav-link active show" href="#tab1" data-toggle="tab">Franchise Details</a>
                                    </li>  
                                                                                       
                                </ul>
                            </div>
                        </div>
                        <div class="white-box">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active fontawesome-demo" id="tab1">
                                    <div id="biography" >

                                        <div class="row profilecoderow">
                                            
                                            <div class="col-md-6 col-6 b-r"> <strong>User Profile Code</strong>
                                                <br>
                                                <span class="label label-lg label-success lblprofilecode ">{{ $userdetails[0]->profile_code }}</span>
                                            </div>


                                            <div class="col-md-6 col-6 b-r "> <strong>User Type</strong>
                                                <br>
                                                <span class="label label-lg label-danger">{{ $usertype }}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="card-body " id="bar-parent1">
                                                <form method="post" action="{{ route('edit-franchise-detail-staff',$user_id)}}" enctype="multipart/form-data" id="editfranchisedetails-form">{{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Min Investment Amount</label>
                                                                <input type="text" class="form-control"  name="min_investment" id="min_investment" minlength="6" maxlength="11"placeholder="Min Investment Required *" value="{{$userdetails[0]->min_investment}}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Max Investment Amount</label>
                                                                <input type="text" class="form-control" value="{{$userdetails[0]->max_investment}}" name="max_investment" id="max_investment" minlength="6" maxlength="11" placeholder="Max Investment Required *">
                                                            </div> 
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="row">                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">USP 1</label>
                                                                <textarea class="form-control" name="usp1" id="usp1" placeholder="In 150 Words *" maxlength="150">{{ $userdetails[0]->usp1 != null ? $userdetails[0]->usp1 : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">USP 2</label>
                                                                <textarea class="form-control" name="usp2" id="usp2" placeholder="In 150 Words *" maxlength="150">{{ $userdetails[0]->usp2 != null ? $userdetails[0]->usp2 : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">USP 3</label>
                                                                <textarea class="form-control" name="usp3" id="usp3" placeholder="In 150 Words" maxlength="150">{{ $userdetails[0]->usp3 != null ? $userdetails[0]->usp3 : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">USP 4</label>
                                                                <textarea class="form-control" name="usp4" id="usp4" placeholder="In 150 Words" maxlength="150">{{ $userdetails[0]->usp4 != null ? $userdetails[0]->usp4 : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Introduction</label>
                                                                <textarea class="form-control" name="introduction" id="introduction" placeholder="Introduce Your Self / Company / Product (In 40 Words Only) *" maxlength="300">{{ $userdetails[0]->intro != null ? $userdetails[0]->intro : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Idea</label>
                                                                <textarea class="form-control" name="idea" id="idea" placeholder="Describe your business (In 2200 Words Only) *" maxlength="2200">{{ $userdetails[0]->idea != null ? $userdetails[0]->idea : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Team Overview</label>
                                                                <textarea class="form-control" name="team_overview" id="team_overview" placeholder="About your team members (In 700 Words Only) *"  maxlength="700">{{ $userdetails[0]->team != null ? $userdetails[0]->team : '' }}</textarea>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Team Member 1</label>
                                                                <input type="text" class="form-control"  name="member1" id="member1" placeholder="Team Member 1 *" maxlength="30" value="{{$userdetails[0]->team_mem1}}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Member 1 Designation</label>
                                                                <select class="form-control select2-hidden-accessible" name="position1" id="position1" tabindex="-1" aria-hidden="true">
                                                                    <option value="">Designation *</option>
                                                                    @foreach($designationlist as $key => $value)
                                                                    <option value="{{ $value->short}}" {{ $userdetails[0]->team_mem_deg1 != null && $userdetails[0]->team_mem_deg1 == $value->short ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Team Member 2</label>
                                                                <input type="text" class="form-control"  name="member2" id="member2" maxlength="30" placeholder="Team Member 2" value="{{$userdetails[0]->team_mem2}}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Member 2 Designation</label>
                                                                <select class="form-control select2-hidden-accessible" name="position2" id="position2" tabindex="-1" aria-hidden="true">
                                                                    <option value="">Designation *</option>
                                                                    @foreach($designationlist as $key => $value)
                                                                    <option value="{{ $value->short}}" {{ $userdetails[0]->team_mem_deg2 != null && $userdetails[0]->team_mem_deg2 == $value->short ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Team Member 3</label>
                                                                <input type="text" class="form-control"  name="member3" id="member3" placeholder="Team Member 3" maxlength="30" value="{{$userdetails[0]->team_mem3}}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Member 3 Designation</label>
                                                                <select class="form-control select2-hidden-accessible" name="position3" id="position3" tabindex="-1" aria-hidden="true">
                                                                    <option value="">Designation *</option>
                                                                    @foreach($designationlist as $key => $value)
                                                                    <option value="{{ $value->short}}" {{ $userdetails[0]->team_mem_deg3 != null && $userdetails[0]->team_mem_deg3 == $value->short ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Team Member 4</label>
                                                                <input type="text" class="form-control"  name="member4" id="member4" maxlength="30"  placeholder="Team Member 4" value="{{$userdetails[0]->team_mem4}}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Member 4 Designation</label>
                                                                <select class="form-control select2-hidden-accessible" name="position4" id="position4" tabindex="-1" aria-hidden="true">
                                                                    <option value="">Designation *</option>
                                                                    @foreach($designationlist as $key => $value)
                                                                    <option value="{{ $value->short}}" {{ $userdetails[0]->team_mem_deg4 != null && $userdetails[0]->team_mem_deg4 == $value->short ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Picture Of Team Member</label>
                                                                <input type="file" class="form-control" name="member_picture" id="member_picture" value="" >
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Images Of Product/Company/Project (Max 10 Files)</label>
                                                                <input type="file" class="form-control" name="mul_imgs[]" multiple="multiple"  id="mul_imgs" value="">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Video</label>
                                                                <input type="file" class="form-control" name="up_video" id="up_video"  value="">
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Return of Investment</label>
                                                                <input type="text" class="form-control"  name="roi" id="roi" maxlength="3" placeholder="%" value="{{$userdetails[0]->roi}}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Cost of Capital</label>
                                                                <input type="text" class="form-control" value="{{$userdetails[0]->cop}}" id="coc" name="coc" maxlength="3" placeholder="%">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Promotions Investment</label>
                                                                <input type="text" class="form-control" value="{{$userdetails[0]->pi}}" id="pi" name="pi" maxlength="11" placeholder="INR">
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Assured Minimum Dividend</label>
                                                                <input type="text" class="form-control"  id="amd" name="amd" maxlength="3" placeholder="%" value="{{$userdetails[0]->dividend}}">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Fixed Assests</label>
                                                                <input type="text" class="form-control" value="{{$userdetails[0]->fa}}" id="fa" name="fa" maxlength="11" placeholder="INR">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="simpleFormEmail">Ebitda</label>
                                                                <input type="text" class="form-control" value="{{$userdetails[0]->ebitda}}" id="ebitda" name="ebitda" maxlength="3" placeholder="%">
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
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
    <!-- end page content -->
   

   
@endsection