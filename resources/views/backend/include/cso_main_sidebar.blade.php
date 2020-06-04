@php
$currRoute = Route::current()->getName();
$items = Session::get('logindata');

if (!empty(Auth()->guard('cso')->user())) {
    $data = Auth()->guard('cso')->user();
}
if($data['roles'] == 'CSO' ){
    $role = 'Customer Support Officer';
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

                <li class="nav-item start {{ ($currRoute == 'cso-dashborad')  ? 'active' : '' }}">
                    <a href="{{ route("cso-dashborad") }}" class="nav-link nav-toggle">
                        <i class="material-icons">dashboard</i>
                        <span class="title">Dashboard</span>
                        <span class="selected"></span>
                    </a>
                </li>

                @if(in_array("slider", $roles))
                    <li class="nav-item start {{ $currRoute == 'cso-slider'  || $currRoute == 'add-cso-slider'? 'active' : '' }}">
                        <a href="{{ route("cso-slider") }}" class="nav-link nav-toggle">
                            <i class="fa fa-desktop"></i>
                            <span class="title">Slider</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                @endif

                <li class="nav-item start    {{ ($currRoute == 'comments-details-cse')  ? 'active' : '' }}   {{ ($currRoute == 'add-note-cse')  ? 'active' : '' }}  {{ ($currRoute == 'edit-user-details-cse')  ? 'active' : '' }}  {{ ($currRoute == 'user-cse-details-cso')  ? 'active' : '' }} {{ ($currRoute == 'view-cso-cse')  ? 'active' : '' }} {{ ($currRoute == 'cso-cse-allocation-list')  ? 'active' : '' }}">
                    <a href="{{ route("cso-cse-allocation-list") }}" class="nav-link nav-toggle">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span class="title">CSE Allocation</span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item start  {{ ($currRoute == 'cso-user-allocation-list')  ? 'active' : '' }}">
                    <a href="{{ route("cso-user-allocation-list") }}" class="nav-link nav-toggle">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        <span class="title">User Allocation</span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item start  {{ ($currRoute == 'cso-active-user-allocation-list')  ? 'active' : '' }}">
                    <a href="{{ route("cso-active-user-allocation-list") }}" class="nav-link nav-toggle">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        <span class="title">Active User Allocation</span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item start  {{ ($currRoute == 'cso-inactive-user-allocation-list')  ? 'active' : '' }}">
                    <a href="{{ route("cso-inactive-user-allocation-list") }}" class="nav-link nav-toggle">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        <span class="title">Pendding Approver User Allocation</span>
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
