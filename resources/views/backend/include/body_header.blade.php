<!-- start header -->
@php
$items = Session::get('logindata');

@endphp
<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <!-- logo start -->
        <div class="page-logo">
            <img alt="" style="width: 40px;height: 40px;" src="{{ asset('public/frontend/image/united-91.jpg') }}">
            <span class="logo-default" style="font-size: 20px;padding-left: 10px; color: #fff;">WE UNITE 91</span>
        </div>
        <!-- logo end -->
        <ul class="nav navbar-nav navbar-left in">
            <li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
        </ul>


        <!-- start mobile menu -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- end mobile menu -->
        <!-- start header menu -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">


                <!-- start manage user dropdown -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        @if($items[0]['user_image'] == null || $items[0]['user_image'] == '')
                            <img alt="" class="img-circle " src="{{ asset('public/backend/assets/upload/user.jpg') }}" />
                        @else
                            <img alt="" class="img-circle " src="{{ asset('public/backend/assets/upload/'.$items[0]['user_image']) }}" />
                        @endif
                        <span class="username username-hide-on-mobile"> {{ $items[0]['firstname'] }} {{ $items[0]['lastname'] }}</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default animated jello">
                        @if($items[0]['roles'] == "A")
                        <li>
                            <a href="{{ route('admin-profile') }}">
                                <i class="icon-user"></i> Profile </a>
                        </li>

                        <li>
                            <a href="{{ route('change-password') }}">
                                <i class="icon-key"></i> Change Password </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('admin-logout') }}">
                                <i class="icon-logout"></i> Log Out </a>
                        </li>

                    </ul>
                </li>
                <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a id="headerSettingButton" data-original-title="Chat"  class="tooltips mdl-button mdl-js-button mdl-button--icon pull-right" data-upgraded=",MaterialButton">
                      <i class="material-icons">chat</i>
                   </a>
               </li>
            </ul>
        </div>
    </div>
</div>
<!-- end header -->
