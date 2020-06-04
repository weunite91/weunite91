@php
$currentRoute = Route::current()->getName();
    $items = Session::get('logindata');
@endphp
<header>
    <div id="Header">
        <div class="table-div">
            <div class="table-cell logo">
                <a href='{{ route("home") }}'>
                    <img alt="weunite91"  src="{{ asset('public/frontend/image/united-91.png') }}" alt="Weunite91"/></a>
            </div>
            <div class="table-cell header-right">
                <nav>
                    <div id="Main-Menu">
                        <ul class="menu">
                            <li class="{{ ($currentRoute == 'raising-finance'  ? 'menuactive' : '') }} fancy-border"><a
                                    href="{{ route('raising-finance')}}">Business</a></li>
                            <li class="{{ ($currentRoute == 'investor'  ? 'menuactive' : '') }} fancy-border"><a
                                    href="{{ route("investor") }}">Investor</a></li>
                            <li class="{{ ($currentRoute == 'howto-partner'  || $currentRoute == 'howto-invest'  || $currentRoute == 'howto-sell-your-bussiness'  || $currentRoute == 'howto-franchise'   ? 'menuactive' : '') }}">
                                <a href="#">How to</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route("howto-invest") }}">Invest</a></li>
                                    <li><a href="{{ route("howto-sell-your-bussiness") }}">Sell Your Business</a></li>
                                    <li><a href="{{ route("howto-franchise") }}">Franchise Your Business</a></li>
                                    <li><a href="{{ route("howto-partner") }}">Partner With Us</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="header-links">
                            @if(isset($items[0]['firstname']))
                                <li><a>{{ $items[0]['firstname'] }} {{ $items[0]['lastname'] }}</a></li>
                            @else
                                <li><a href="{{ route("login") }}">Join &amp; Login</a></li>
                            @endif

                        </ul>
                        @if(isset($items[0]['firstname']))
                            <ul class="dashboard-links" >
                                <li >
                               
                                    <a href="#"  class="notification" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >
                                        <i class="fa fa-bell"  style="font-size:24px;color:#144f94">
                                        <span class="badge"></span>
                                        </i>
                                    </a>    
                                    <ul class="dropdown-menu dropdown-menu-right notify-drop" style="width:500px !important;
                                    ">
            <div class="notify-drop-title" style="padding-left:5px !important;pading-bottom:5px !important">
            	<div class="row">
            		<div class="col-md-6 col-sm-6 col-xs-6"><b>Notifications</b></div>
            		<div class="col-md-6 col-sm-6 col-xs-6 text-right"></div>
            	</div>
            </div>
           
            <div class="drop-content" id="divNotificationDetails" style="background-color:rgb(238, 238, 238) !important;height:200px !important;overflow-x:hidden;">
            	
            	
            </div>
            <div class="notify-drop-footer text-center">
            	<a href="{{ asset('/') }}/get-all-proposal-list/all"><i class="fa fa-eye"></i> view all</a>
            </div>
          </ul>
                                </li>
                            </ul>
                        @endif
                       @if(isset($items[0]['firstname']))
                            <ul class="dashboard-links">
                                <li><a href="#">
                                        <img src="{{asset('public/frontend')}}/image/user.png" alt="Unable to display user's image"/></a>
                                    <ul class="dashboard-link-list">
                                        
                                        <li><a href="{{ route($items[0]['dash_url'])}}">My Dashboard</a></li>
                                        <li><a href="{{url('logout')}}">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        @endif
                    </div>
                    <div id="Mobile-Menu">
                        <div class="menu-mobile"><a href="javascript:void(0);"></a></div>
                        <div class="Wrapper"></div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
