<!DOCTYPE html>
<html lang="en">
    @include('frontend.include.header')

    <body class="home">
        <div id="Container"> 
            @include('frontend.include.body_header')
            @include('frontend.include.gladassistmodel')
            <div id="divoverlayspinner">
                <div id="divspinner"><img src="{{ asset('/') }}public/frontend/image/spinner.gif" alt="In Progress" /></div>
            </div>
            @yield('content')	

            @include('frontend.include.body_footer')
        </div>
        @include('frontend.include.footer')
        @include('frontend.include.model')
        <div id="loader"></div>
        <script src="{{ asset('public/sitecommon.js') }}" type="text/javascript" ></script>

    </body>

</html>