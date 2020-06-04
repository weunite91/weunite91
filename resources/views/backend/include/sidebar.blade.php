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

                            <a class="tooltips" href="{{ route("crew-list") }}" data-placement="top" data-original-title="Crew Management">
                                <i class="material-icons">person_outline</i>
                            </a>

                            <a class="tooltips" href="{{ route("cso-list") }}" data-placement="top" data-original-title="CSO Management">
                                <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
                            </a>

                            <a class="tooltips" href="{{ route("my-note") }}" data-placement="top" data-original-title="My Note">
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
                        <span class="title">Dashboard</span>
                        <span class="selected"></span>
                    </a>
                </li>


                <li class="nav-item start {{ $currRoute == 'admin-slider'  || $currRoute == 'add-slider'? 'active' : '' }}">
                    <a href="{{ route("admin-slider") }}" class="nav-link nav-toggle">
                        <i class="fa fa-desktop"></i>
                        <span class="title">Slider</span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item start {{ $currRoute == 'admin-email-image'  ? 'active' : '' }}">
                    <a href="{{ route("admin-email-image") }}" class="nav-link nav-toggle">
                        <i class="fa fa-picture-o"></i>
                        <span class="title">Email Images</span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item start {{ ($currRoute == 'admin-cold-user')  ? 'active' : '' }}{{ ($currRoute == 'admin-all-user')  ? 'active' : '' }} ">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="fa fa-user-times"></i>
                        <span class="title">Cold User</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ ($currRoute == 'admin-all-user')    ? 'active' : '' }} ">
                            <a href="{{ route("admin-all-user") }}" class="nav-link ">
                                <span class="title">All Users</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item {{ ($currRoute == 'admin-cold-user')    ? 'active' : '' }} ">
                            <a href="{{ route("admin-cold-user") }}" class="nav-link ">
                                <span class="title">Cold Users</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item start {{ ($currRoute == 'comments-details')  ? 'active' : '' }} {{ ($currRoute == 'admin-franchise')  ? 'active' : '' }} {{ ($currRoute == 'investor-admin')  ? 'active' : '' }}  {{ ($currRoute == 'edit-user-details')  ? 'active' : '' }} {{ ($currRoute == 'user-details')  ? 'active' : '' }} {{ ($currRoute == 'fund-raiser')  ? 'active' : '' }}  {{ ($currRoute == 'partner')  ? 'active' : '' }}  {{ ($currRoute == 'all-users')  ? 'active' : '' }}">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="fa fa-users"></i>
                        <span class="title">User Profile</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ ($currRoute == 'edit-user-details')    ? 'active' : '' }} {{ ($currRoute == 'user-details')    ? 'active' : '' }} {{ ($currRoute == 'all-users')    ? 'active' : '' }}">
                            <a href="{{ route("all-users") }}" class="nav-link ">
                                <span class="title">All Users</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item {{ ($currRoute == 'fund-raiser')  ? 'active' : '' }}">
                            <a href="{{ route("fund-raiser") }}" class="nav-link ">
                                <span class="title">Fund Raiser</span>
                            </a>
                        </li>

                        <li class="nav-item {{ ($currRoute == 'investor-admin')  ? 'active' : '' }}">
                            <a href="{{ route("investor-admin") }}" class="nav-link ">
                                <span class="title">Investor</span>
                            </a>
                        </li>

                        <li class="nav-item {{ ($currRoute == 'partner')  ? 'active' : '' }}">
                            <a href="{{ route("partner") }}" class="nav-link ">
                                <span class="title">Partner</span>
                            </a>
                        </li>

                        <li class="nav-item {{ ($currRoute == 'admin-franchise')  ? 'active' : '' }}">
                            <a href="{{ route("admin-franchise") }}" class="nav-link ">
                                <span class="title">Franchise</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item start {{ ($currRoute == 'all-active-users')  ? 'active' : '' }} {{ ($currRoute == 'active-fund-raiser')  ? 'active' : '' }}  {{ ($currRoute == 'edit-user-details')  ? 'active' : '' }} {{ ($currRoute == 'active-investor-admin')  ? 'active' : '' }} {{ ($currRoute == 'active-partner')  ? 'active' : '' }}  {{ ($currRoute == 'active-admin-franchise')  ? 'active' : '' }}  ">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="fa fa-users"></i>
                        <span class="title">Active User Profile</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ ($currRoute == 'edit-active-user-details')    ? 'active' : '' }} {{ ($currRoute == 'active-user-details')    ? 'active' : '' }} {{ ($currRoute == 'all-active-users')    ? 'active' : '' }}">
                            <a href="{{ route("all-active-users") }}" class="nav-link ">
                                <span class="title">All Users</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item {{ ($currRoute == 'active-fund-raiser')  ? 'active' : '' }}">
                            <a href="{{ route("active-fund-raiser") }}" class="nav-link ">
                                <span class="title">Fund Raiser</span>
                            </a>
                        </li>

                        <li class="nav-item {{ ($currRoute == 'active-investor-admin')  ? 'active' : '' }}">
                            <a href="{{ route("active-investor-admin") }}" class="nav-link ">
                                <span class="title">Investor</span>
                            </a>
                        </li>

                        <li class="nav-item {{ ($currRoute == 'active-partner')  ? 'active' : '' }}">
                            <a href="{{ route("active-partner") }}" class="nav-link ">
                                <span class="title">Partner</span>
                            </a>
                        </li>

                        <li class="nav-item {{ ($currRoute == 'active-admin-franchise')  ? 'active' : '' }}">
                            <a href="{{ route("active-admin-franchise") }}" class="nav-link ">
                                <span class="title">Franchise</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item start {{ ($currRoute == 'franchise-pending-approval')    ? 'active' : '' }} {{ ($currRoute == 'investor-pending-approval')    ? 'active' : '' }}{{ ($currRoute == 'partner-pending-approval')    ? 'active' : '' }}  {{ ($currRoute == 'pending-approval')    ? 'active' : '' }} {{ ($currRoute == 'fund-raiser-pending-approval')    ? 'active' : '' }}">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="fa fa-users"></i>
                        <span class="title">Pending User Profile</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ ($currRoute == 'pending-approval')    ? 'active' : '' }} ">
                            <a href="{{ route("pending-approval") }}" class="nav-link nav-toggle">
                                <span class="title">All Users</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item {{ ($currRoute == 'fund-raiser-pending-approval')  ? 'active' : '' }}">
                            <a href="{{ route("fund-raiser-pending-approval") }}" class="nav-link ">
                                <span class="title">Fund Raiser</span>
                            </a>
                        </li>

                        <li class="nav-item {{ ($currRoute == 'investor-pending-approval')  ? 'active' : '' }}">
                            <a href="{{ route("investor-pending-approval") }}" class="nav-link ">
                                <span class="title">Investor</span>
                            </a>
                        </li>

                        <li class="nav-item {{ ($currRoute == 'partner-pending-approval')  ? 'active' : '' }}">
                            <a href="{{ route("partner-pending-approval") }}" class="nav-link ">
                                <span class="title">Partner</span>
                            </a>
                        </li>

                        <li class="nav-item {{ ($currRoute == 'franchise-pending-approval')  ? 'active' : '' }}">
                            <a href="{{ route("franchise-pending-approval") }}" class="nav-link ">
                                <span class="title">Franchise</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item start {{ ($currRoute == 'email-verify')  ? 'active' : '' }}">
                    <a href="{{ route("email-verify") }}" class="nav-link nav-toggle">
                        <i class="fa fa-envelope-open"></i>
                        <span class="title">Pending Email Verify Profile</span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item start {{ ($currRoute == 'verify-address-list')  ? 'active' : '' }}">
                    <a href="{{ route("verify-address-list") }}" class="nav-link nav-toggle">
                        <i class="fa fa-address-card"></i>
                        <span class="title">Verify Address Profiles</span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item start {{ ($currRoute == 'inactive-list')  ? 'active' : '' }}">
                    <a href="{{ route("inactive-list") }}" class="nav-link nav-toggle">
                        <i class="fa fa-ban"></i>
                        <span class="title">InActive Profiles</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start {{ ($currRoute == 'delete-request')  ? 'active' : '' }}">
                    <a href="{{ route("delete-request") }}" class="nav-link nav-toggle">
                        <i class="fa fa-trash"></i>
                        <span class="title">Pending Delete Profile Request</span>
                        <span class="selected"></span>
                    </a>
                </li>


                <li class="nav-item start {{ ($currRoute == 'peoposal')  ? 'active' : ''}} {{ ($currRoute == 'view-proposal')  ? 'active' : ''}}">
                    <a href="{{ route("peoposal") }}" class="nav-link nav-toggle">
                        <i class="fa fa-anchor" ></i>
                        <span class="title">Proposal</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start {{ ($currRoute == 'revokeoffers')  ? 'active' : ''}}">
                    <a href="{{ route("revokeoffers") }}" class="nav-link nav-toggle">
                        <i class="fa fa-times" ></i>
                        <span class="title">Revoke Offers</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start {{ ($currRoute == 'approvedrevoke')  ? 'active' : ''}}">
                    <a href="{{ route("approvedrevoke") }}" class="nav-link nav-toggle">
                        <i class="fa fa-check-square-o" ></i>
                        <span class="title">Approved Revoke</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start {{ ($currRoute == 'allpayment')  ? 'active' : ''}}">
                    <a href="{{ route("allpayment") }}" class="nav-link nav-toggle">
                        <i class="fa fa-credit-card" ></i>
                        <span class="title">All Payments</span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item start {{ ($currRoute == 'gladassist')  ? 'active' : ''}}">
                    <a href="{{ route("gladassist") }}" class="nav-link nav-toggle">
                        <i class="fa fa-weixin" ></i>
                        <span class="title">Glad to assist request</span>
                        <span class="selected"></span>
                    </a>
                </li>


                <li class="nav-item start {{ ($currRoute == 'supportrequest')  ? 'active' : ''}}">
                    <a href="{{ route("supportrequest") }}" class="nav-link nav-toggle">
                        <i class="fa fa-weixin" ></i>
                        <span class="title">Support Request</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start {{ ($currRoute == 'kpisupportrequest')  ? 'active' : ''}}">
                    <a href="{{ route("kpisupportrequest") }}" class="nav-link nav-toggle">
                        <i class="fa fa-weixin" ></i>
                        <span class="title">KPI Support Request</span>
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
