<!DOCTYPE html>
<html lang="en">
<style>
 #divoverlayspinner {
  position: fixed;
  display:none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}

#divspinner{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 50px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);

}
</style>
    @include('backend.include.header')
    <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark" >
        <div class="page-wrapper">
            @include('backend.include.body_header')
            <div id="divoverlayspinner">
                <div id="divspinner"><img src="{{ asset('/') }}public/frontend/image/spinner.gif" alt="In Progress" /></div>
            </div>

            <!-- start page container -->
            <div class="page-container">
                @php
                    $items = Session::get('logindata');
                @endphp
                @include('backend.include.cso_sidebar')

                @yield('content')
            </div>
            <!-- end page container -->

            @include('backend.include.body_footer')
            @include('backend.include.footer')
        </div>
        @include('backend.include.popup')
    </body>
</html>
