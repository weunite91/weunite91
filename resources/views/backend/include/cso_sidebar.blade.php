@php
$currRoute = Route::current()->getName();
$items = Session::get('logindata');
if (!empty(Auth()->guard('admin')->user())) {
    $data = Auth()->guard('admin')->user();
}
if($data['roles'] == 'A' ){
$role = 'Admin';
}


if($items[0]['roles'] == 'S' ){
$role = 'Staff';
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

                        <div class="sidebar-userpic-btn">
                            <a class="tooltips" href="{{ route("admin-dashborad") }}" data-placement="top" data-original-title="Admin">
                                <i class="fa fa-user-secret" ></i>
                            </a>

                            <a class="tooltips" href="{{ route("crew-list") }}" data-placement="top" data-original-title="Crew Management">
                                <i class="material-icons">person_outline</i>
                            </a>


                            <a class="tooltips" href="chat.html" data-placement="top" data-original-title="My Note">
                                <i class="fa fa-sticky-note" aria-hidden="true"></i>
                            </a>

                            <a class="tooltips" href="{{ route("logout") }}" data-placement="top" data-original-title="Logout">
                                <i class="material-icons">input</i>
                            </a>
                        </div>

                    </div>
                </li>

                <li class="nav-item start {{ ($currRoute == 'admin-dashborad')  ? 'active' : '' }}">
                    <a href="{{ route("admin-dashborad") }}" class="nav-link nav-toggle">
                        <i class="material-icons">dashboard</i>
                        <span class="title">Admin</span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item start {{ ($currRoute == 'cso-list')  ? 'active' : '' }} {{ ($currRoute == 'view-cso')  ? 'active' : '' }} {{ ($currRoute == 'edit-cso')  ? 'active' : '' }}">
                    <a href="{{ route("cso-list") }}" class="nav-link nav-toggle">
                        <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
                        <span class="title">CSO Management</span>
                        <span class="selected"></span>
                    </a>
                </li>


                <li class="nav-item start {{ ($currRoute == 'cse-allocation')  ? 'active' : '' }} ">
                    <a href="{{ route("cse-allocation") }}" class="nav-link nav-toggle">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        <span class="title">CSE Allocation</span>
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
