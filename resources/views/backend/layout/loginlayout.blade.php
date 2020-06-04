<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="description" content="Responsive Admin Template" />
        <meta name="author" content="SmartUniversity" />
        <title>{{ $title }}</title>
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
       
        <link href="{{ asset('public/backend/assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{ asset('public/backend/assets/plugins/iconic/css/material-design-iconic-font.min.css') }}">

        <link href="{{ asset('public/backend/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    
        <link href="{{ asset('public/backend/assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
        
        <link rel="stylesheet" href="{{ asset('public/backend/assets/css/pages/extra_pages.css') }}">
            <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('public/backend/assets/img/favicon.ico') }}" /> 
        <style>
        .error{
            color:red;
        }
        </style>
    </head>
    <body>
        
         @yield('content')
        <script src="{{ asset('public/backend/assets/plugins/jquery/jquery.min.js') }}" ></script>
        <!-- bootstrap -->
        <script src="{{ asset('public/backend/assets/plugins/bootstrap/js/bootstrap.min.js') }}" ></script>
        <script src="{{ asset('public/backend/assets/js/pages/extra_pages/login.js') }}" ></script>
        <script src="{{ asset('public/backend/assets/js/plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/backend/assets/js/comman_function.js') }}" type="text/javascript"></script>
        @if (!empty($pluginjs)) 
            @foreach ($pluginjs as $value) 
                <script src="{{ url('public/backend/assets/js/plugins/'.$value) }}" type="text/javascript"></script>
            @endforeach
        @endif
        @if (!empty($js)) 
            @foreach ($js as $value) 
                <script src="{{ url('public/backend/assets/js/customjs/'.$value) }}" type="text/javascript"></script>
            @endforeach
        @endif
    <script>
            jQuery(document).ready(function() {
            @if (!empty($funinit))
                    @foreach ($funinit as $value)
            {{  $value }}
            @endforeach
                    @endif
            });
    </script>
    </body>
</html>