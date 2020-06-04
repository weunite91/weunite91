@php
$currRoute = Route::current()->getName();
$items = Session::get('logindata');

if (!empty(Auth()->guard('staff')->user())) {
$data = Auth()->guard('staff')->user();
}
if($data['roles'] == 'S' ){
    $role = 'Staff';
}


if($data['asign_role']){
    $roles = json_decode($data['asign_role']) ;
}else{
    $roles = [];
}

@endphp
<!-- start sidebar menu -->
<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll">
            <ul class="sidemenu page-header-fixed p-t-20" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <li class="sidebar-user-panel">
                    <div class="user-panel">
                        <div class="row">
                            <div class="sidebar-userpic">
                                @if($data['user_image'] == null || $data['user_image'] == '')
                                <img src="{{ asset('public/backend/assets/upload/user.jpg') }}" class="img-responsive" alt="">
                                @else
                                <img src="{{ asset('public/upload/'.$data['user_image']) }}" class="img-responsive" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="profile-usertitle">
                            <div class="sidebar-userpic-name"> {{ $data['firstname'] }} {{ $data['lastname'] }} </div>
                            <div class="profile-usertitle-job"> {{ $role }} </div>
                        </div>

                    </div>
                </li>

                <li class="nav-item start {{ ($currRoute == 'staff-dashborad')  ? 'active' : '' }}">
                    <a href="{{ route("staff-dashborad") }}" class="nav-link nav-toggle">
                        <i class="material-icons">dashboard</i>
                        <span class="title">Dashboard</span>
                        <span class="selected"></span>
                    </a>
                </li>
                @if(in_array("slider", $roles))
                    <li class="nav-item start {{ $currRoute == 'staff-slider'  || $currRoute == 'add-staff-slider'? 'active' : '' }}">
                        <a href="{{ route("staff-slider") }}" class="nav-link nav-toggle">
                            <i class="fa fa-desktop"></i>
                            <span class="title">Slider</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                @endif
                
                @if(in_array("emailImages", $roles))
                    <li class="nav-item start {{ $currRoute == 'staff-email-images'  ? 'active' : '' }}">
                        <a href="{{ route("staff-email-images") }}" class="nav-link nav-toggle">
                            <i class="fa fa-desktop"></i>
                            <span class="title">Email Images</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                @endif

                <li class="nav-item start {{ ($currRoute == 'pending-profile')  ? 'active' : '' }} {{ ($currRoute == 'comments-details-staff')  ? 'active' : '' }}">
                    <a href="{{ route("pending-profile") }}" class="nav-link nav-toggle">
                        <i class="fa fa-user-o"></i>
                        <span class="title">Active Profile</span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item start {{ ($currRoute == 'pending-approval-staff')  ? 'active' : '' }}">
                    <a href="{{ route("pending-approval-staff") }}" class="nav-link nav-toggle">
                        <i class="fa fa-clock-o"></i>
                        <span class="title">Pending Approval</span>
                        <span class="selected"></span>
                    </a>
                </li>


            </ul>
            </li>
            </ul>
        </div>
    </div>
</div>
<!-- end sidebar menu -->
