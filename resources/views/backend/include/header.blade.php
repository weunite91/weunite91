
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />
    <title>{{ $title }}</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="{{ asset('public/backend/assets/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <!--bootstrap -->
    <link href="{{ asset('public/backend/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/assets/plugins/summernote/summernote.css') }}" rel="stylesheet">
    <!-- morris chart -->
    <link href="{{ asset('public/backend/assets/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/plugins/material/material.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/material_style.css') }}">
    <!-- animation -->
    <link href="{{ asset('public/backend/assets/css/pages/animate_page.css') }}" rel="stylesheet">
    <!-- Template Styles -->
    <link href="{{ asset('public/backend/assets/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/assets/css/theme-color.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/frontend/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('public/backend/assets/img/favicon.ico') }}" /> 
    <link rel="stylesheet" href="{{ asset('public/backend/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css') }}">
    <script type="text/javascript">
            var baseurl = "{{ asset('/') }}";
    
    </script>
</head>