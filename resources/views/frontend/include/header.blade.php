@php
$currentRoute = Route::current()->getName();
@endphp
<head>

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">

    <meta property="og:title" content="https://www.weunite91.com/" />
    <meta property="og:url" content="https://www.weunite91.com/" />
    <meta property="og:description" content="World's most effectual fund raising dais">

    <meta property="og:image" content="https://www.weunite91.com/public/frontend/image/wa.png"/>  
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="300" />
    <meta property="og:type" content="website" />

    <meta property="og:locale" content="en_IN" />
    <meta property="og:locale:alternate" content="fr_US" />
    <meta property="og:locale:alternate" content="es_UK" />

    <link rel="shortcut icon" href="{{ asset('public/frontend/image/united-91.png') }}" type="image/x-icon">
    <link href="{{ asset('public/frontend/css/lightslider.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/frontend/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/frontend/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <link href="{{ asset('public/frontend/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/frontend/css/my.css') }}" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
        var baseurl = "{{ asset('/') }}";
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-163287856-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-163287856-1');
    </script>
    
</head>